<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="activateDialog" persistent max-width="400px">
        <v-card>
          <v-form v-model="valid" ref="activateUserForm" @submit.prevent="activateUser">
            <v-card-title>Activate User</v-card-title>
            <v-divider></v-divider>
            <v-card-text class="mb-5" style="height: 150px;">
              <h3 class="mt-4" style="color:white">Write code: Activate</h3>
              <v-divider></v-divider>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-text-field
                v-model="confirmActivateCode"
                class="mt-5"
                :counter="10"
                :rules="[rules.required, rules.max10]"
                label="Confirm Code"
                required
              ></v-text-field>
            </v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                class="float-right"
                color="blue darken-1"
                text
                @click="closeActivateDialog"
              >Close</v-btn>
              <v-btn class="float-right" color="blue darken-1" text type="submit">Save</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>
    <SnackbarComponent
      :snackbarActivate="this.snackbarActivate"
      :sendSnackBarText="this.snackBarText"
    ></SnackbarComponent>
  </div>
</template>
<script>
import SnackbarComponent from "./SnackBar";
export default {
  components: {
    SnackbarComponent
  },
  props: {
    dialog: Boolean,
    dialogId: String
  },
  data() {
    return {
      snackbarActivate: false,
      snackBarText: "",
      activateDialog: false,
      confirmActivateCode: "",
      isComplete: false,
      valid: false,
      rules: {
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters"
      }
    };
  },
  methods: {
    activateUser() {
      if (this.$refs.activateUserForm.validate()) {
        if (this.confirmActivateCode.toUpperCase() == "ACTIVATE") {
          var app = this;
          this.axios
            .post("/api/users/:undelete", {
              id: app.dialogId
            })
            .then(function() {
              app.activateDialog = false;
              app.confirmActivateCode = "";
              app.$emit("refreshUsers", null);
            })
            .catch(error => {
              //handle error
              if (error.response.status === 403) {
                this.snackbarActivate = !this.snackbarActivate;
                this.snackBarText = error.response.data;
              }
            });
        } else {
          this.snackbarActivate = !this.snackbarActivate;
          this.snackBarText = "Incorrect Code";
        }
      }
    },
    closeActivateDialog() {
      this.activateDialog = false;
    }
  },
  watch: {
    dialog: function() {
      this.activateDialog = true;
    }
  }
};
</script>