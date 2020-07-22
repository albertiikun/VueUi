<template>
  <div>
    <v-container>
      <ShowGroups></ShowGroups>
    </v-container>
  </div>
</template>
<script>
const ShowGroups = () => import("./showGroups/Handler");

export default {
  components: {
    ShowGroups
  }
};
</script>