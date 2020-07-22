<template>
  <v-card>
    <v-tabs background-color="#212121" color="white" center-active dark>
      <v-tab v-if="this.$hasPermissions.includes('edit-info ' + role)">
        <v-icon left>mdi-account</v-icon>Personal Info
      </v-tab>
      <v-tab v-if="this.$hasPermissions.includes('edit-password ' + role)">
        <v-icon left>mdi-lock</v-icon>Security
      </v-tab>
      <v-tab v-if="this.$hasPermissions.includes('edit-username-email ' + role)">
        <v-icon left>mdi-access-point</v-icon>Username & Email
      </v-tab>
      <v-tab>
        <v-icon left>mdi-information</v-icon>Group Hours
      </v-tab>

      <v-tab-item v-if="this.$hasPermissions.includes('edit-info ' + role)">
        <v-card flat>
          <PersonalInfo :id="id"></PersonalInfo>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text v-if="$hasPermissions.includes('edit-password ' + role)">
            <Security :id="id"></Security>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text v-if="$hasPermissions.includes('edit-username-email ' + role)">
            <UpdateUsernameOrEmail :id="id"></UpdateUsernameOrEmail>
          </v-card-text>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <v-card-text>
            <GroupHoursInfo :id="id"></GroupHoursInfo>
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
const GroupHoursInfo = () => import("./GroupHoursInfo");
export default {
  components: {
    PersonalInfo,
    Security,
    UpdateUsernameOrEmail,
    GroupHoursInfo
  },
  props: {
    id: String,
    role: String
  },
  mounted() {
    if (this.id == null) {
      this.$router.push({ name: "Users" });
    }
  }
};
</script>