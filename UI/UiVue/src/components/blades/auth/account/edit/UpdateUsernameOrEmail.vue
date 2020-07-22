<template>
  <div>
    <v-form v-model="valid" ref="submitFormRef" @submit.prevent="submitForm">
      <v-container>
        <v-row>
          <v-col cols="12" md="12">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="formData.userName"
              :rules="[rules.required, rules.min, rules.userName, this.isTaken.userName ? rules.userNameIsTaken : true]"
              :counter="100"
              label="Username"
              required
              @change="clearValidationUsername"
            >
              <v-icon slot="prepend" color="white">mdi-account-circle</v-icon>
            </v-text-field>
          </v-col>
          <v-col cols="12" md="12">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              :rules="[rules.required, rules.min, rules.email, rules.max100, this.isTaken.email ? rules.emailIsTaken : true]"
              :counter="100"
              label="Email"
              v-model="formData.email"
              required
              @change="clearValidationEmail"
            >
              <v-icon slot="prepend" color="white">mdi-email</v-icon>
            </v-text-field>
            <v-sheet
              class="float-right ml-5 mt-5"
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
            >
              <v-skeleton-loader class="mx-auto" type="button"></v-skeleton-loader>
            </v-sheet>
            <v-btn
              v-if="complete"
              class="float-right ml-5 mt-5"
              color="primary"
              type="submit"
              :loading="loadingSubmitButton"
            >Submit</v-btn>
            <v-sheet
              class="float-right ml-5 mt-5"
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
            >
              <v-skeleton-loader class="mx-auto" type="button"></v-skeleton-loader>
            </v-sheet>
            <v-btn v-if="complete" class="float-right mt-5" text @click="resetForm">Reset Defaults</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
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
  inject: ["theme"],
  mounted() {
    this.getUserId();
    this.getUsernameAndEmail();
  },

  data() {
    return {
      id: null,
      isTaken: {
        email: false,
        userName: false
      },
      loadingSubmitButton: false,
      complete: false,
      snackbarActivate: false,
      snackBarText: "",
      formData: {
        email: "",
        userName: ""
      },
      valid: false,
      rules: {
        emailIsTaken: "Email is taken",
        userNameIsTaken: "Username is taken",
        min: v => (v && v.length >= 8) || "Min 8 characters",
        passMatch: v =>
          v == this.security.newPassword ||
          "The password you entered don't match",
        passStrong: v =>
          /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(
            v
          ) || "Password is weak, please use uppercase, number and symbol.",
        required: v => !!v || "This field is required",
        max100: v => v.length <= 100 || "Max 100 characters",
        email: v =>
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(([[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            v
          ) || "E-mail format invalid",
        userName: v =>
          /^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/.test(
            v
          ) || "Username format invalid"
      }
    };
  },
  methods: {
    getUsernameAndEmail: function() {
      var app = this;
      this.axios
        .get("/api/users/:username-email-id", {
          params: {
            id: app.id
          }
        })
        .then(res => {
          app.formData.email = res.data.email;
          app.formData.userName = res.data.userName;
          app.complete = true;
        })
        .catch(error => {
          //handle error
          if (error.response.status === 403) {
            this.snackbarActivate = !this.snackbarActivate;
            this.snackBarText = error.response.data;
          }
        });
    },
    submitForm: function() {
      if (this.$refs.submitFormRef.validate()) {
        this.loadingSubmitButton = true;
        var app = this;
        this.axios
          .put("api/users/:update-username-email", {
            id: app.id,
            email: app.formData.email,
            userName: app.formData.userName
          })
          .then(res => {
            this.snackbarActivate = !this.snackbarActivate;
            this.snackBarText = res.data;
            this.loadingSubmitButton = false;
          })
          .catch(error => {
            //handle error
            if (error.response.status === 403) {
              this.snackbarActivate = !this.snackbarActivate;
              this.snackBarText = error.response.data;
            } else if (error.response.status === 422) {
              if (error.response.data["email"]) {
                this.isTaken.email = true;
              } else if (error.response.data["userName"]) {
                this.isTaken.userName = true;
              }
              this.loadingSubmitButton = false;
            }
          });
      }
    },
    resetForm: function() {
      this.complete = false;
      this.getUsernameAndEmail();
    },
    clearValidationEmail() {
      this.isTaken.email = false;
    },
    clearValidationUsername() {
      this.isTaken.userName = false;
    },
    getUserId() {
      var token = localStorage.getItem("default_auth_token");
      var parsedToken = JSON.parse(atob(token.split(".")[1]));
      this.id = parsedToken.sub;
    }
  }
};
</script>