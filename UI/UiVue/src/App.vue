<template>
  <v-app id="inspire">
    <SideBar :drawerval="this.drawer" :avatarUrl="this.avatarUrl" @drawed="drawed"></SideBar>

    <TopBar @clickDrawer="OnClickDrawer"></TopBar>

    <v-content>
      <Dashboard v-if="this.$route.name == 'Home'"></Dashboard>
      <router-view v-else :isDrawed="this.isDrawed"></router-view>
    </v-content>

    <DialogButton></DialogButton>
    <Footer></Footer>
  </v-app>
</template>

<script>
import SideBar from "./components/blades/auth/menu/SideBar";
import DialogButton from "./components/blades/auth/menu/DialogButton";
import TopBar from "./components/blades/auth/menu/TopBar";
import Footer from "./components/blades/auth/menu/Footer";
import Dashboard from "./components/blades/auth/dashboard/Handler";
export default {
  mounted() {
  },
  components: {
    SideBar,
    DialogButton,
    TopBar,
    Footer,
    Dashboard
  },
  data() {
    return {
      avatarUrl:
        "https://cdn.dribbble.com/users/199982/screenshots/4044699/furkan-avatar-dribbble.png",
      drawer: null,
      isDrawed: null,
      fabVal: null
    };
  },
  props: {
    source: String
  },
  methods: {
    OnClickDrawer(value) {
      this.drawer = value;
    },
    drawed(value) {
      this.isDrawed = value;
    }
  }
};
</script>