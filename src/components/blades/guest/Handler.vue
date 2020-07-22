<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <login
              v-if="this.step == 1"
              @stepToResetPassword="stepToResetPassword"
              :reset="this.reset"
            ></login>
            <forgotPassword v-if="this.step == 2" @stepToLogin="stepToLogin"></forgotPassword>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
const login = () => import("./login/Handler");
const forgotPassword = () => import("./forgotPassword/Handler");
export default {
  props: {
    reset: String
  },
  components: {
    login,
    forgotPassword
  },
  data() {
    return {
      step: 1
    };
  },
  methods: {
    stepToResetPassword() {
      this.step = 2;
    },
    stepToLogin() {
      this.step = 1;
    }
  }
};
</script>