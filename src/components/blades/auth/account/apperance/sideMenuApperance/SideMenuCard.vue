<template>
  <div>
    <v-card class="mx-auto" color="black" dark max-width="400">
      <v-card-title>
        <v-icon large left>mdi-format-color-fill</v-icon>
        <span class="title font-weight-light">Menu Apperance</span>
      </v-card-title>

      <v-card-text></v-card-text>

      <v-card-actions>
        <v-list-item class="grow">
          <v-row align="center" justify="end">
            <SideMenuBgColor></SideMenuBgColor>
            <SideMenuButtonBgColor></SideMenuButtonBgColor>
          </v-row>
        </v-list-item>
      </v-card-actions>
    </v-card>
  </div>
</template>
<script>
const SideMenuBgColor = () => import("./sideMenuBgColor/Handler");
const SideMenuButtonBgColor = () => import("./sideMenuButtonBgColor/Handler");
export default {
  components: {
    SideMenuBgColor,
    SideMenuButtonBgColor
  }
};
</script>