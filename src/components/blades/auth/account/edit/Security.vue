<template>
  <div>
    <v-form v-model="valid" ref="SecurityForm">
      <v-container>
        <v-row>
          <v-col cols="12" md="12">
            <v-text-field
              v-model="security.oldPassword"
              :rules="[rules.required, rules.min]"
              :counter="10"
              label="Old Password"
              required
              :type="passwordEye.show1 ? 'text' : 'password'"
              @click:append="passwordEye.show1 = !passwordEye.show1"
              :append-icon="passwordEye.show1 ? 'visibility' : 'visibility_off'"
            >
              <v-icon slot="prepend" color="red">mdi-key</v-icon>
            </v-text-field>
          </v-col>

          <v-col cols="12" md="12">
            <v-text-field
              v-model="security.newPassword"
              v-on:keyup="passwordChanged"
              :rules="[rules.required,rules.min,rules.passStrong]"
              :counter="10"
              label="New Password"
              required
              :type="passwordEye.show2 ? 'text' : 'password'"
              @click:append="passwordEye.show2 = !passwordEye.show2"
              :append-icon="passwordEye.show2 ? 'visibility' : 'visibility_off'"
            >
              <v-icon v-if="passwordAnimation.lock" slot="prepend" color="red">mdi-lock-open</v-icon>
              <v-icon v-else slot="prepend" color="green">mdi-lock</v-icon>
            </v-text-field>
          </v-col>

          <v-col cols="12" md="12">
            <v-text-field
              v-model="security.confirmNewPassword"
              :rules="[rules.required,rules.min,rules.passMatch]"
              label="Confirm New Password"
              required
              ref="newPasswordConfirmed"
              @keyup="NewPasswordConfirm"
              :type="passwordEye.show3 ? 'text' : 'password'"
              @click:append="passwordEye.show3 = !passwordEye.show3"
              :append-icon="passwordEye.show3 ? 'visibility' : 'visibility_off'"
            >
              <v-icon v-if="passwordAnimation.lock" slot="prepend" color="red">mdi-lock-open</v-icon>
              <v-icon v-else slot="prepend" color="green">mdi-lock</v-icon>
            </v-text-field>

            <v-btn
              class="float-right ml-5 mt-5"
              color="primary"
              @click="validate"
              :loading="isLoading"
            >Submit</v-btn>
            <v-btn class="float-right mt-5" text>Cancel</v-btn>
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
const SnackbarComponent = () => import("./SnackBar");
export default {
  components: {
    SnackbarComponent
  },
  mounted() {
    this.getUserId();
  },
  data() {
    return {
      isLoading: false,
      snackbarActivate: false,
      snackBarText: "",
      id: null,
      valid: false,
      security: {
        oldPassword: "",
        newPassword: "",
        confirmNewPassword: ""
      },
      passwordEye: {
        show1: false,
        show2: false,
        show3: false
      },
      passwordAnimation: {
        lock: true
      },
      rules: {
        min: v => (v && v.length >= 8) || "Min 8 characters",
        passMatch: v =>
          v == this.security.newPassword ||
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
    NewPasswordConfirm: function() {
      if (this.$refs.newPasswordConfirmed.validate()) {
        this.passwordAnimation.lock = false;
      } else {
        this.passwordAnimation.lock = true;
      }
    },
    passwordChanged: function() {
      this.security.confirmNewPassword = "";
    },
    validate() {
      if (this.$refs.SecurityForm.validate()) {
        this.ChangePassword();
      }
    },
    ChangePassword() {
      this.isLoading = true;
      var app = this;
      this.axios
        .put("/api/users/:update-password", {
          id: app.id,
          oldPassword: app.security.oldPassword,
          password: app.security.newPassword,
          password_confirmation: app.security.confirmNewPassword
        })
        .then(res => {
          app.isLoading = false;
          app.snackbarActivate = !app.snackbarActivate;
          app.snackBarText = res.data;
        })
        .catch(error => {
          app.isLoading = false;
          app.snackbarActivate = !app.snackbarActivate;
          app.snackBarText = error.response.data;
        });
    },
    getUserId() {
      var token = localStorage.getItem("default_auth_token");
      var parsedToken = JSON.parse(atob(token.split(".")[1]));
      this.id = parsedToken.sub;
    }
  }
};
</script>