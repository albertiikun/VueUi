<template>
  <v-card>
    <v-tabs background-color="#212121" color="white" center-active dark>
      <v-tab>
        <v-icon left>mdi-account</v-icon>Personal Info
      </v-tab>
      <v-tab>
        <v-icon left>mdi-lock</v-icon>Security
      </v-tab>
      <v-tab>
        <v-icon left>mdi-access-point</v-icon>Username & Email
      </v-tab>

      <v-tab-item>
        <v-card flat>
          <PersonalInfo :id="id"></PersonalInfo>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
            <Security :id="id"></Security>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
            <UpdateUsernameOrEmail :id="id"></UpdateUsernameOrEmail>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>
<script>
const PersonalInfo = () => import("./PersonalInfo");
const Security = () => import("./Security");
const UpdateUsernameOrEmail = () => import("./UpdateUsernameOrEmail");
export default {
  components: {
    PersonalInfo,
    Security,
    UpdateUsernameOrEmail
  },
  props: {
    id: String
  }
};
</script>