<template>
  <div>
    <v-card id="UsersToolCard">
      <v-card id="create">
        <v-speed-dial
          v-model="fab"
          :top="true"
          :left="true"
          :direction="direction"
          transition="slide-y-transition"
        >
          <template v-slot:activator>
            <v-btn
              dark
              link
              id="ToolButtons"
              :class="{'toolButtons':toolButtons, 'first-button':true}"
            >
              <v-icon v-if="fab">mdi-close</v-icon>
              <v-icon v-else>mdi-account</v-icon>
            </v-btn>
          </template>
          <v-btn
            dark
            exact
            @click.stop
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Users','inactive': this.$route.name != 'Users'}"
            id="ToolButtons"
            :to="{ name: 'Users' }"
          >
            <v-icon>mdi-home</v-icon>
          </v-btn>
          <v-btn
            :disabled="checkPermsission('register')"
            dark
            exact
            @click.stop
            id="ToolButtons"
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Register','inactive': this.$route.name != 'Register'}"
            link
            :to="{ name: 'Register' }"
          >
            <v-icon>mdi-plus</v-icon>
          </v-btn>
          <v-btn
            :disabled="checkPermsission('edit')"
            dark
            exact
            @click.stop
            id="ToolButtons"
            :class="{'toolButtons':toolButtons,'NavMenuBgColor': this.$route.name == 'Edit','inactive': this.$route.name != 'Edit'}"
          >
            <v-icon>mdi-pencil</v-icon>
          </v-btn>

          <v-btn
            :disabled="checkPermsission('get-deactivated')"
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
    isDrawed: Boolean,
    activator: String
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
  },
  methods: {
    checkPermsission(startsWith) {
      const hasPermission = this.$hasPermissions.filter(permission =>
        permission.startsWith(startsWith)
      );
      if (hasPermission.length == 0) {
        return true;
      } else {
        return false;
      }
    }
  }
};
</script>

<style lang="css" scoped>
/* This is for documentation purposes and will not be needed in your application */
#create .v-speed-dial {
  position: absolute;
}
.active {
  background-color: #2196f3 !important;
}
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
.v-speed-dial--is-actives {
  position: relative;
}
</style> 