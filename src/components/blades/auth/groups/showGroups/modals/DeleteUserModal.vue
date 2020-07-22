<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px" scrollable>
        <v-card>
          <v-card-title>
            <span class="headline">Unassign users from group</span>
          </v-card-title>
          <v-card-text style="max-height: 500px;">
            <v-container>
              <v-row>Show Users Table</v-row>
              <v-row v-if="isLoading" justify="center">
                <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
              </v-row>
            </v-container>
            <div v-if="isEmpty">No data</div>
            <v-banner v-for="user in userList" :key="user.id">
              <v-icon slot="icon" color="warning" size="36">mdi-account</v-icon>
              {{user.name}} {{user.lastName}} {{user.email}}
              <template v-slot:actions>
                <v-checkbox
                  v-model="selected"
                  append-icon="mdi-delete"
                  color="red"
                  :value="user.id"
                  hide-details
                ></v-checkbox>
              </template>
            </v-banner>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="red darken-1" text @click="submitUnassignForm">Submit</v-btn>
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
      selected: [],
      dialog: false,
      userList: [],
      isEmpty: false,
      isLoading: false
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
      this.selected = [];
      this.$emit("showDeleteUsersDialogIfOpen", val);
    },
    selected(val) {
      console.log(val);
    }
  },
  methods: {
    getUsers() {
      this.userList = [];
      this.isLoading = true;
      var app = this;
      this.axios
        .get("api/groups/:users-group-id", {
          params: {
            id: app.id
          }
        })
        .then(response => {
          app.isLoading = false;
          if (response.data.length == 0) {
            app.isEmpty = true;
          } else {
            app.isEmpty = false;
          }
          for (let i = 0; i < response.data.length; i++) {
            app.userList.push(response.data[i]);
          }
        });
    },
    submitUnassignForm() {
      if (this.selected.length == 0) {
        this.$emit("snackbarActivateFun", null);
        this.$emit("sendSnackBarTextFun", "No one is selected! Check again.");
      } else {
        var app = this;
        this.axios
          .delete("api/groups/:unassign-user", {
            data: {
              user_id: app.selected,
              group_id: app.id
            }
          })
          .then(response => {
            app.dialog = false;
            app.$emit("refreshGroups", null);
            app.$emit("snackbarColorFun", "");
            app.$emit("snackbarActivateFun", null);
            app.$emit("sendSnackBarTextFun", response.data);
          })
          .catch(err => {
            app.$emit("snackbarColorFun", "red darken-3");
            app.$emit("snackbarActivateFun", null);
            app.$emit("sendSnackBarTextFun", err.response.data);
          });
      }
    }
  }
};
</script>