<template>
  <div>
    <v-app-bar app clipped-left color="TopBarBgColor">
      <v-app-bar-nav-icon @click="clickDrawer" class="textDefault--text" />

      <v-toolbar-title class="textDefault--text">Application</v-toolbar-title>
      <v-spacer></v-spacer>

      <label class="v-label textDefault--text">Navbar</label>
    </v-app-bar>
  </div>
</template>
<script>
export default {
  data() {
    return {
      drawer: true
    };
  },
  methods: {
    clickDrawer: function() {
      this.drawer = !this.drawer;
      this.$emit("clickDrawer", this.drawer);
    }
  }
};
</script>
