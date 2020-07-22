<template>
  <div>
    <div>
      <NavButtons :isDrawed="this.isDrawed"></NavButtons>
    </div>
    <div>
      <v-container>
        <v-divider class="marginTop" vertical></v-divider>
        <EditAccount v-if="this.$route.name == 'Account'"></EditAccount>
        <router-view v-else></router-view>
      </v-container>
    </div>
  </div>
</template>
<script>
const NavButtons = () => import("./NavButtons");
const EditAccount = () => import("./edit/Handler");
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
    EditAccount
  },
  props: {
    isDrawed: Boolean,
  },
};
</script>
<style lang="css">
.marginTop {
  margin-top: 6rem;
  transition: all 0.3s ease-in-out;
}
</style>
