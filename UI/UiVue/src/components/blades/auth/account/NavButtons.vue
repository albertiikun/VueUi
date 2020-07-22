<template>
  <div>
    <v-card id="UsersToolCard">
      <v-card id="create">
        <v-speed-dial
          :absolute="true"
          v-model="fab"
          :top="true"
          :left="true"
          :direction="direction"
          transition="slide-y-transition"
        >
          <template v-slot:activator>
            <v-btn
              v-model="fab"
              dark
              link
              id="ToolButtons"
              :class="{'toolButtons':toolButtons, 'first-button':true}"
            >
              <v-icon v-if="fab">mdi-close</v-icon>
              <v-icon v-else>mdi-buffer</v-icon>
            </v-btn>
          </template>
          <v-btn
            dark
            exact
            @click.stop
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Account','inactive': this.$route.name != 'Account'}"
            id="ToolButtons"
            :to="{ name: 'Account' }"
          >
            <v-icon>mdi-account-edit</v-icon>
          </v-btn>
          <v-btn
            dark
            exact
            @click.stop
            id="ToolButtons"
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Button','inactive': this.$route.name != 'Button'}"
            link
            :to="{ name: 'Button' }"
          >
            <v-icon>mdi-brush</v-icon>
          </v-btn>
          <v-btn
            dark
            exact
            @click.stop
            id="ToolButtons"
            link
            :to="{ name: 'Role' }"
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Role','inactive': this.$route.name != 'Role'}"
          >
            <v-icon>mdi-account-convert</v-icon>
          </v-btn>

          <v-btn
            link
            exact
            :to="{ name: 'Deleted' }"
            dark
            @click.stop
            id="ToolButtons"
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Deleted','inactive': this.$route.name != 'Deleted'}"
          >
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-speed-dial>
      </v-card>
    </v-card>
  </div>
</template>
<script>
export default {
  data: () => ({
    direction: "right",
    fab: true,
    toolButtons: false
  }),

  props: {
    isDrawed: Boolean
  },
  watch: {
    isDrawed: function(oldVal) {
      if (oldVal == false) {
        this.toolButtons = true;
      } else {
        this.toolButtons = false;
      }
    }
  },

  mounted() {
    window.onresize = () => {
      if (window.innerWidth < 1000) {
        this.direction = "bottom";
      } else {
        this.direction = "right";
      }
    };
  }
};
</script>

<style lang="css" scoped>
/* This is for documentation purposes and will not be needed in your application */

.inactive {
  background-color: #000000 !important;
}

#create .v-btn--floating {
  position: relative;
}
#UsersToolCard {
  margin-left: 5vw;
}
#ToolButtons {
  margin-right: 2vw;
  width: 12vw;
  height: 6vh;
}
.toolButtons {
  margin-right: 2vw;
  width: 15vw !important;
  height: 6vh !important;
}

@media only screen and (max-width: 999px) {
  .first-button {
    margin-left: 4px;
  }
}
</style> 