<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar color="primary" dark flat>
        <v-toolbar-title>Login</v-toolbar-title>
        <v-spacer />
      </v-toolbar>
      <v-card-text>
        <v-form @submit.prevent="loginForm" v-model="valid" ref="loginForm">
          <v-text-field
            label="Email or username"
            :rules="emailRule"
            name="Email"
            v-model="email"
            prepend-icon="person"
            type="text"
          />

          <v-text-field
            id="password"
            label="Password"
            v-model="password"
            prepend-icon="lock"
            type="password"
            :rules="passwordRule"
          />
          <div class="col-md-12">
            <a class="float-left mt-2" @click="forgotPassword">Forgot Password</a>
            <v-btn type="submit" class="float-right" color="primary" :loading="loading">Login</v-btn>
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
  mounted() {
    if (this.$route.params.reset != undefined) {
      this.snackbarText = this.$route.params.reset;
      this.snackbar = true;
      this.$route.params.reset = undefined;
    }
  },
  data() {
    return {
      valid: false,
      loading: false,
      email: "",
      password: "",
      snackbar: false,
      snackbarText: "Email or password is invalid!",
      emailRule: [
        v => !!v || "Email is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      passwordRule: [
        v => !!v || "Password is required",
        v => v.length >= 8 || "Min 8 characters"
      ]
    };
  },

  methods: {
    loginForm: function() {
      if (!this.$refs.loginForm.validate()) {
        this.snackbarText = "Please check Fields";
        this.snackbar = true;
      } else {
        this.loading = true;
        this.$auth.login({
          data: {
            username: this.email,
            password: this.password,
            client_secret: "JQSjqwTfoyS76AeyxBSBFkqTEBOuL9CuZ6cHAKxm",
            client_id: "1",
            scope: "*",
            grant_type: "password",
            rememberMe: true
          },

          success: function() {
            this.loading = false;
          },
          error: function() {
            this.loading = false;
            this.snackbarText = "Email or password is invalid!";
            this.snackbar = true;
          },
          rememberMe: true,
          fetchUser: true
        });
      }
    },
    forgotPassword() {
      this.$emit("stepToResetPassword", null);
    }
  }
};
</script>