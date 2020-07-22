<template>
  <div>
    <v-form v-model="valid" ref="submitFormEditLevelGroup" @submit.prevent="submitForm">
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-btn class="float-right" fab dark small color="primary" @click="clickPlus">
              <v-icon dark>mdi-plus</v-icon>
            </v-btn>
            <v-btn class="float-left" fab dark small color="red" @click="clickMinus">
              <v-icon dark>mdi-minus</v-icon>
            </v-btn>
          </v-col>
          <v-col cols="12">
            <v-text-field
              disabled
              v-model="model.level"
              v-text="`${this.model.levelText + ' '+ this.model.level}`"
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
        levelText: "",
        level: ""
      },
      isTaken: {
        name: false
      },
      subjects: [],
      dialog: false,
      valid: false,
      rules: {
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters",
        unsigned: v => v > 0 || "You cannot chose value lower than 0",
        maxNumber: v => v <= 100 || "You should chose number 100 or less"
      }
    };
  },
  methods: {
    clickPlus() {
      if (this.model.level >= this.data.maxLevel) {
        this.$emit("sendSnackFun", {
          text: "Max Level reached",
          color: "red darken-3"
        });
      } else {
        this.model.level++;
        if (this.data.groupLevel == this.model.level) {
          this.model.levelText = "Current: ";
        } else if (this.data.groupLevel < this.model.level) {
          this.model.levelText = "Upgrade: ";
        } else {
          this.model.levelText = "Downgrade: ";
        }
      }
    },
    clickMinus() {
      if (this.model.level <= 0) {
        this.$emit("sendSnackFun", {
          text: "Min Level reached",
          color: "red darken-3"
        });
      } else {
        this.model.level--;
        if (this.data.groupLevel == this.model.level) {
          this.model.levelText = "Current: ";
        } else if (this.data.groupLevel < this.model.level) {
          this.model.levelText = "Upgrade: ";
        } else {
          this.model.levelText = "Downgrade :";
        }
      }
    },
    AssignData() {
      this.model.levelText = "Current: ";
      this.model.level = this.data.groupLevel;
    },
    closeDialog() {
      this.$emit("closeDialog", null);
    },
    submitForm() {
      var app = this;
      if (this.$refs.submitFormEditLevelGroup.validate()) {
        this.isLoadingSubmit = true;
        this.axios
          .post("api/groups/:update-group-level", {
            id: app.data.groupId,
            level: app.model.level
          })
          .then(response => {
            app.isLoadingSubmit = false;
            app.$emit("refreshGroups", null);
            app.$emit("sendSnackFun", {
              text: response.data
            });
          })
          .catch(error => {
            app.isLoadingSubmit = false;
            app.$emit("sendSnackFun", {
              text: error.response.data
            });
          });
      }
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