<template>
  <div>
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  mounted() {
    this.$vuetify.theme.dark = true;
  }
};
</script>