<template>
  <div>
    <v-container>
      Request reset password by email:
      <v-row justify="center">
        <v-btn
          class="ml-5 mt-5"
          color="primary"
          :loading="!this.email"
          @click="resetPassword"
        >Reset Passsword</v-btn>
      </v-row>
    </v-container>
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
    this.getUsernameAndEmail();
  },
  props: {
    id: String
  },
  data() {
    return {
      email: "",
      snackbarActivate: false,
      snackBarText: ""
    };
  },
  methods: {
    resetPassword() {
      var app = this;
      this.axios
        .get("api/oauth/forgot-password", {
          params: {
            email: app.email
          }
        })
        .then(response => {
          this.snackbarActivate = !this.snackbarActivate;
          this.snackBarText = response.data;
        });
    },
    getUsernameAndEmail: function() {
      var app = this;
      this.axios
        .get("/api/users/:username-email-id", {
          params: {
            id: app.id
          }
        })
        .then(response => {
          app.email = response.data.email;
        });
    }
  }
};
</script>