<template>
  <div>
    <div>
      <NavButtons :isDrawed="this.isDrawed"></NavButtons>
    </div>
    <div>
      <v-container>
        <v-divider style="margin-top: 6rem;" vertical></v-divider>
        <UserDataTable v-if="this.$route.name == 'Users'" @editUserId="editId"></UserDataTable>
        <router-view v-else :editIdValue="this.editIdValue"></router-view>
      </v-container>
    </div>
  </div>
</template>
<script>
const NavButtons = () => import("./NavButtons");
const UserDataTable = () => import("./show/UserDataTable");
export default {
  data() {
    return {
      editIdValue: ""
    };
  },
  methods: {
    editId: function(value) {
      this.editIdValue = value;
    }
  },
  components: {
    NavButtons,
    UserDataTable
  },
  props: {
    isDrawed: Boolean
  }
};
</script>