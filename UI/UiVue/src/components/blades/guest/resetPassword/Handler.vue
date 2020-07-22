<template>
  <div>
    <v-app id="inspire">
      <v-content>
        <v-container class="fill-height" fluid>
          <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="4">
              <v-card class="elevation-12">
                <v-toolbar color="primary" dark flat>
                  <v-toolbar-title>Reset Password</v-toolbar-title>
                  <v-spacer />
                </v-toolbar>
                <v-card-text>
                  <v-form @submit.prevent="submitForm" v-model="valid" ref="resetPasswordForm">
                    <v-text-field
                      id="password"
                      label="Email"
                      v-model="email"
                      prepend-icon="email"
                      readonly
                    />

                    <v-text-field
                      id="password"
                      label="Password"
                      v-model="password"
                      prepend-icon="lock"
                      type="password"
                      :rules="[rules.required,rules.min,rules.passStrong]"
                      v-on:keyup="passwordChanged"
                    />

                    <v-text-field
                      id="password"
                      label="Password Confirmation"
                      v-model="passwordConfirmation"
                      prepend-icon="lock"
                      type="password"
                      :rules="[rules.required,rules.min,rules.passStrong, rules.passMatch]"
                    />
                    <div class="col-md-12">
                      <a class="float-left mt-2" @click="toLogin">Back to login</a>
                      <v-btn
                        type="submit"
                        class="float-right"
                        color="primary"
                        :loading="loading"
                      >Submit</v-btn>
                    </div>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer />
                </v-card-actions>
              </v-card>

              <div class="text-center">
                <v-snackbar v-model="snackbar">
                  {{ snackbarText }}
                  <v-btn color="red" text @click="snackbar = false">Close</v-btn>
                </v-snackbar>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </v-content>
    </v-app>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.$route.query.token == null) {
      this.$router.push({
        name: "Login",
        params: { reset: "You don't have access to this page" }
      });
    }
  },
  data() {
    return {
      valid: false,
      loading: false,
      email: this.$route.query.email,
      passwordConfirmation: "",
      password: "",
      snackbar: false,
      snackbarText: "Email or password is invalid!",
      rules: {
        min: v => (v && v.length >= 8) || "Min 8 characters",
        passMatch: v =>
          v == this.passwordConfirmation ||
          "The password you entered don't match",
        passStrong: v =>
          /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(
            v
          ) || "Password is weak, please use uppercase, number and symbol.",
        required: v => !!v || "This field is required"
      }
    };
  },

  methods: {
    submitForm: function() {
      if (!this.$refs.resetPasswordForm.validate()) {
        this.snackbarText = "Please check Fields";
        this.snackbar = true;
      } else {
        this.loading = true;
        var app = this;
        this.axios
          .post("api/oauth/reset-password", {
            token: app.$route.query.token,
            password: app.password,
            password_confirmation: app.passwordConfirmation
          })
          .then(res => {
            this.loading = false;
            this.$router.push({
              name: "Login",
              params: { reset: res.data }
            });
          })
          .catch(err => {
            this.loading = false;
            this.$router.push({
              name: "Login",
              params: { reset: err.response.data }
            });
          });
      }
    },
    toLogin() {
      this.$router.push({
        name: "Login"
      });
    },
    passwordChanged() {
      this.passwordConfirmation = "";
    }
  }
};
</script>