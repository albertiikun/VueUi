<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar color="primary" dark flat>
        <v-toolbar-title>Forgot Password</v-toolbar-title>
        <v-spacer />
      </v-toolbar>
      <v-card-text>
        <v-form @submit.prevent="submitForm" v-model="valid" ref="fromForgotPassword">
          <v-text-field
            label="Email"
            :rules="emailRule"
            name="Email"
            v-model="email"
            prepend-icon="person"
            type="text"
          />

          <div class="col-md-12">
            <a class="float-left mt-2" @click="stepToLogin">Back to login</a>
            <v-btn type="submit" class="float-right" color="primary" :loading="loading">Submit</v-btn>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      valid: false,
      loading: false,
      email: "",
      snackbar: false,
      snackbarText: "Email or password is invalid!",
      emailRule: [
        v => !!v || "Email is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ]
    };
  },

  methods: {
    submitForm: function() {
      if (this.$refs.fromForgotPassword.validate()) {
        this.loading = true;
        var app = this;
        this.axios
          .get("api/oauth/forgot-password", {
            params: {
              email: app.email
            }
          })
          .then(res => {
            this.loading = false;
            this.snackbarText = res.data;
            this.snackbar = true;
          })
          .catch(err => {
            this.loading = false;
            this.snackbarText = err.response.data;
            this.snackbar = true;
          });
      } else {
        this.snackbarText = "Please check Fields";
        this.snackbar = true;
      }
    },
    stepToLogin() {
      this.$emit("stepToLogin", null);
    }
  }
};
</script>