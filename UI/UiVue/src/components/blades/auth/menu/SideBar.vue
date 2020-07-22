<template>
  <div>
    <v-navigation-drawer v-model="drawer" app clipped class="SideMenuBgColor">
      <img class="card-avatar" :src="avatarUrl" />
      <v-list dense>
        <v-list-item link :to="{ name: 'Home' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item
          link
          :to="{ name: 'Users' }"
          active-class="SideMenuActiveButton"
          v-if="checkPermsission('get')"
        >
          <v-list-item-action>
            <v-icon>mdi-account-settings</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Users Panel</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link :to="{ name: 'Groups' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Groups</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link :to="{ name: 'Exams' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-pencil-box</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Exams</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link :to="{ name: 'Events' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-calendar-month</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Event Calendar</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link :to="{ name: 'Payments' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-credit-card</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Payments</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link :to="{ name: 'Account' }" active-class="SideMenuActiveButton">
          <v-list-item-action>
            <v-icon>mdi-cogs</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Account</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link class="logout" @click="logout">
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
export default {
  data() {
    return {
      drawer: true
    };
  },
  props: {
    drawerval: Boolean,
    avatarUrl: String
  },
  watch: {
    drawerval: function() {
      this.drawer = !this.drawer;
    },
    drawer: function() {
      this.$emit("drawed", this.drawer);
    }
  },
  methods: {
    logout: function() {
      this.$auth.logout({
        success: function() {},
        error: function() {}
      });
    },
    checkPermsission(startsWith) {
      const hasPermission = this.$hasPermissions.filter(permission =>
        permission.startsWith(startsWith)
      );
      if (hasPermission.length == 0) {
        return false;
      } else {
        return true;
      }
    }
  }
};
</script>
<style lang="css" scoped>
.card-avatar {
  height: 12rem;
  width: 100%;
}
.logout:hover {
  background-color: red;
  transition: 0.5s;
}
</style>
