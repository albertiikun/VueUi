<template>
  <div>
    <v-form v-model="valid" ref="submitFormEditGroup" @submit.prevent="submitForm">
      <v-container>
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-model="model.name"
              class="mt-5"
              :counter="10"
              :rules="[rules.required, rules.max10, this.isTaken.name ? rules.nameIsTaken : true]"
              label="Group Name"
              required
              @change="clearNameIsTaken"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-select
              v-model="model.subject"
              class="mt-5"
              :rules="[rules.required]"
              :items="subjects"
              item-text="name"
              item-value="id"
              label="Select Subject"
              return-object
              single-line
            ></v-select>
          </v-col>
          <v-col cols="6">
            <v-text-field
              type="number"
              v-model.number="model.maxLevel"
              class="mt-5"
              :counter="10"
              :rules="[rules.required, rules.unsigned, rules.maxNumber]"
              label="Group Max Level"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              type="number"
              v-model.number="model.studentLimit"
              class="mt-5"
              :counter="10"
              :rules="[rules.required, rules.unsigned, rules.maxNumber]"
              label="Student Limit"
              required
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-divider></v-divider>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="AssignData">Reset Default</v-btn>
        <v-btn color="blue darken-1" text :loading="isLoadingSubmit" @click="submitForm">Submit</v-btn>
      </v-card-actions>
    </v-form>
  </div>
</template>
<script>
export default {
  mounted() {
    this.getSubjects();
    this.AssignData();
  },

  props: {
    dialogVal: Boolean,
    data: Object
  },
  data() {
    return {
      isLoadingSubmit: false,
      model: {
        name: "",
        subject: { id: "", name: "" },
        maxLevel: 0,
        studentLimit: 0
      },
      isTaken: {
        name: false
      },
      subjects: [],
      dialog: false,
      valid: false,
      rules: {
        nameIsTaken: "Name is already been taken",
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters",
        unsigned: v => v > 0 || "You cannot chose value lower than 0",
        maxNumber: v => v <= 100 || "You should chose number 100 or less"
      }
    };
  },
  methods: {
    AssignData() {
      this.getSubjects();
      this.model.name = this.data.groupName;
      this.model.level = this.data.groupLevel;
      this.model.studentLimit = this.data.studentLimit;
      this.model.maxLevel = this.data.maxLevel;
      this.model.subject.id = this.data.subjectId;
      this.model.subject.name = this.data.subject;
    },
    closeDialog() {
      this.$emit("closeDialog", null);
    },
    submitForm() {
      var app = this;
      if (this.$refs.submitFormEditGroup.validate()) {
        this.isLoadingSubmit = true;
        this.axios
          .post("api/groups/:update", {
            id: app.data.groupId,
            name: app.model.name,
            subject_Id: app.model.subject.id,
            maxLevel: app.model.maxLevel,
            studentLimit: app.model.studentLimit
          })
          .then(response => {
            app.isLoadingSubmit = false;
            app.$emit("closeDialog", null);
            app.$emit("refreshGroups", null);
            app.$emit("sendSnackFun", { text: response.data, color: "" });
          })
          .catch(error => {
            app.$emit("sendSnackFun", {
              text: error.response.data,
              color: "red darken-3"
            });
            app.isLoadingSubmit = false;
            if (error.response.status === 422) {
              if (error.response.data["name"]) {
                this.isTaken.name = true;
              }
            }
          });
      }
    },
    clearNameIsTaken() {
      this.isTaken.name = false;
    },
    getSubjects() {
      this.axios.get("api/groups/:group-sujects").then(response => {
        for (let i = 0; i < response.data.length; i++) {
          this.subjects.push(response.data[i]);
        }
      });
    }
  },
  watch: {
    dialogVal(val) {
      this.dialog = val;
    },
    dialog(val) {
      this.$emit("dialog", val);
    },
    data() {
      this.AssignData();
    }
  }
};
</script>