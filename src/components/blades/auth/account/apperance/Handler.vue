<template>
  <div>
    <v-sheet class="px-3">
      <v-row justify="center">
        <v-col cols="4">
          <SideMenuApperance></SideMenuApperance>
        </v-col>
        <v-col cols="4">
          <TopMenuApperanceCard></TopMenuApperanceCard>
        </v-col>
        <v-col cols="4">
          <NavMenuApperanceCard></NavMenuApperanceCard>
        </v-col>
      </v-row>
    </v-sheet>
  </div>
</template>
<script>
const SideMenuApperance = () => import("./sideMenuApperance/SideMenuCard");
const TopMenuApperanceCard = () =>
  import("./topMenuApperance/TopMenuApperanceCard");
const NavMenuApperanceCard = () =>
  import("./navMenuApperance/NavMenuApperanceCard");

export default {
  components: {
    SideMenuApperance,
    TopMenuApperanceCard,
    NavMenuApperanceCard
  }
};
</script>

