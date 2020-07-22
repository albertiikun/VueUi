<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">
        <v-card>
          <v-form v-model="valid" ref="submitFormGroup" @submit.prevent="submitForm">
            <v-card-title>
              <span class="headline">Create Group</span>
            </v-card-title>
            <v-card-text>
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
                  <v-col cols="4">
                    <v-text-field
                      type="number"
                      v-model.number="model.level"
                      class="mt-5"
                      :counter="10"
                      :rules="[rules.requiredNumber, rules.unsigned, rules.maxNumber]"
                      label="Group Level"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      type="number"
                      v-model.number="model.maxLevel"
                      class="mt-5"
                      :counter="10"
                      :rules="[rules.requiredNumber, rules.unsigned, rules.maxNumber]"
                      label="Group Max Level"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      type="number"
                      v-model.number="model.studentLimit"
                      class="mt-5"
                      :counter="10"
                      :rules="[rules.requiredNumber, rules.unsigned, rules.maxNumber]"
                      label="Student Limit"
                      required
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn color="blue darken-1" text type="submit">Save</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  mounted() {
    this.getSubjects();
  },

  props: {
    dialogVal: Boolean
  },
  data() {
    return {
      model: {
        name: "",
        subject: "",
        level: 0,
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
        requiredNumber: v => v != null || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters",
        unsigned: v => v >= 0 || "You cannot chose value lower than 0",
        maxNumber: v => v <= 100 || "You should chose number 100 or less"
      }
    };
  },
  methods: {
    submitForm() {
      var app = this;
      if (this.$refs.submitFormGroup.validate()) {
        this.axios
          .post("api/groups/:create", {
            name: app.model.name,
            subject_Id: app.model.subject.id,
            level: app.model.level,
            maxLevel: app.model.maxLevel,
            studentLimit: app.model.studentLimit
          })
          .then(function() {
            app.dialog = false;
            app.$emit("refreshGroups", null);
          })
          .catch(error => {
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
    }
  }
};
</script>