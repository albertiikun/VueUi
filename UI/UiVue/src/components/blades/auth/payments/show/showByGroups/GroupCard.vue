<template>
  <div>
    <v-card dark color="black">
      <v-card-title>
        <v-icon large left>mdi-format-color-fill</v-icon>
        <span class="title font-weight-light">{{group.name}}</span>
      </v-card-title>
      <v-card-text></v-card-text>
      <v-card-actions>
        <v-list-item class="grow" link style="background-color:#56aff6;" @click="openUsersDialog">
          <v-row align="center" justify="center">
            <v-icon>mdi-credit-card</v-icon>
          </v-row>
        </v-list-item>
      </v-card-actions>
    </v-card>
  </div>
</template>
<script>
export default {
  props: {
    group: Object
  },
  methods: {
    openUsersDialog() {
      this.$emit("openUsersDialog", this.group.id);
    }
  }
};
</script>