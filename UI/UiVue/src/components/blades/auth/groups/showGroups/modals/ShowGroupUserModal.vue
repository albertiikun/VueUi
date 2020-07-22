<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px" scrollable>
        <v-card>
          <v-card-title>
            <span class="headline">User Profile</span>
          </v-card-title>
          <v-card-text style="max-height: 500px;">
            <v-container>
              <v-row>
                <v-col cols="10">
                  <div class="mt-5">
                    <label class="v-label textDefault--text">Students</label>
                  </div>
                </v-col>
                <v-col cols="2">
                  <div>
                    <v-switch v-model="switcher" hide-details inset></v-switch>
                  </div>
                </v-col>
              </v-row>
              <v-row v-if="isLoading" justify="center">
                <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
              </v-row>
            </v-container>
            <div v-if="isEmpty && !isLoading">No data</div>
            <div v-if="!isLoading">
              <v-banner
                v-for="user in userList"
                :key="user.id"
                :color="activated.includes(user.id) ? 'green' : 'red'"
              >
                <v-icon slot="icon" color="warning" size="36">mdi-account</v-icon>
                {{user.name}} {{user.lastName}} {{user.email}}
                <template v-slot:actions>
                  <v-checkbox
                    v-model="selectedActivate"
                    append-icon="mdi-account-check"
                    color="green"
                    :value="user.id"
                    hide-details
                    v-if="checkNotIncludes(user.id)"
                  ></v-checkbox>
                  <v-checkbox
                    v-model="selectedUnactive"
                    append-icon="mdi-account-arrow-right"
                    color="red"
                    :value="user.id"
                    hide-details
                    v-if="checkIncludes(user.id)"
                  ></v-checkbox>
                </template>
              </v-banner>
            </div>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn
              text
              color="blue darken-1"
              :disabled="disabled"
              :loading="submitLoading"
              @click="submitForm"
            >Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  props: {
    id: String,
    open: Boolean
  },
  data() {
    return {
      submitLoading: false,
      disabled: true,
      switcher: false,
      selectedActivate: [],
      selectedUnactive: [],
      dialog: false,
      userList: [],
      isEmpty: false,
      isLoading: false,
      activated: []
    };
  },
  watch: {
    open(val) {
      if (val == true) {
        this.isEmpty = false;
        this.getUsers();
      }
      this.dialog = val;
    },
    dialog(val) {
      this.$emit("showGroupUsersDialogWatch", val);
    },
    switcher() {
      this.selectedActivate = [];
      this.selectedUnactive = [];
    },
    selectedActivate() {
      if (
        this.selectedActivate.length != 0 ||
        this.selectedUnactive.length != 0
      ) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    },
    selectedUnactive() {
      if (
        this.selectedActivate.length != 0 ||
        this.selectedUnactive.length != 0
      ) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    }
  },
  methods: {
    getUsers() {
      this.isLoading = true;
      var app = this;
      this.axios
        .get("api/groups/:users-group-id", {
          params: {
            id: app.id
          }
        })
        .then(response => {
          app.userList = [];
          if (response.data.length == 0) {
            app.isEmpty = true;
          } else {
            app.isEmpty = false;
          }
          for (let i = 0; i < response.data.length; i++) {
            app.userList.push(response.data[i]);
          }
          app.getActivatedUsers();
        });
    },
    checkNotIncludes(id) {
      if (this.activated.includes(id) == true || this.switcher == true) {
        return false;
      } else {
        return true;
      }
    },
    checkIncludes(id) {
      if (this.activated.includes(id) == false || this.switcher == false) {
        return false;
      } else {
        return true;
      }
    },
    getActivatedUsers() {
      var app = this;
      this.axios
        .get("api/groups/:activated-users", {
          params: {
            group_id: app.id
          }
        })
        .then(response => {
          app.activated = [];
          for (let i = 0; i < response.data.length; i++) {
            app.activated.push(response.data[i]);
          }
          app.isLoading = false;
        })
        .catch(function() {
          app.isLoading = false;
        });
    },
    submitForm() {
      var app = this;
      if (this.switcher === false) {
        this.submitLoading = true;
        this.axios
          .post("api/groups/:active-user", {
            group_id: app.id,
            user_id: app.selectedActivate
          })
          .then(function() {
            app.isLoading = true;
            app.getUsers();
          })
          .catch(function() {})
          .then(function() {
            app.isLoading = false;
            app.submitLoading = false;
            app.selectedActivate = [];
          });
      } else {
        this.submitLoading = true;
        this.axios
          .post("api/groups/:unactive-user", {
            group_id: app.id,
            user_id: app.selectedUnactive
          })
          .then(response => {
            app.isLoading = true;
            app.getUsers();
            console.log(response);
          })
          .catch(function() {})
          .then(function() {
            app.selectedUnactive = [];
            app.submitLoading = false;
            app.isLoading = false;
          });
      }
    }
  }
};
</script>