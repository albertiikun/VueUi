<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px" scrollable>
        <v-card>
          <v-card-title>
            <span class="headline">Users</span>
          </v-card-title>
          <v-card-text style="max-height: 500px;">
            <v-row v-if="isLoading" justify="center">
              <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
            </v-row>
            <div v-if="isEmpty && !isLoading">No data</div>
            <div v-if="!isLoading">
              <v-banner v-for="user in users" :key="user.id">
                <v-icon slot="icon" color="warning" size="36">mdi-account</v-icon>
                {{user.name}} {{user.lastName}}
                <template v-slot:actions>
                  <v-btn @click="openAssignPaymentDialogInfo(user.id)">
                    <v-icon>mdi-information</v-icon>
                  </v-btn>
                  <v-btn @click="openAssignPaymetDialog(user.id)">
                    <v-icon>mdi-account-cash</v-icon>
                  </v-btn>
                </template>
              </v-banner>
            </div>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  mounted() {},
  props: {
    open: Boolean,
    id: String
  },
  data() {
    return {
      isLoading: false,
      isEmpty: false,
      dialog: false,
      users: []
    };
  },
  methods: {
    getUsers() {
      var app = this;
      app.isLoading = true;
      this.axios
        .get("api/payments/:get-users-by-group-id", {
          params: {
            group_id: app.id
          }
        })
        .then(response => {
          app.users = [];
          if (response.data.length == 0) {
            app.isEmpty = true;
          } else {
            app.isEmpty = false;
          }
          for (let i = 0; i < response.data.length; i++) {
            app.users.push(response.data[i]);
          }
          app.isLoading = false;
        })
        .catch(error => {
          console.log(error);
          app.isLoading = false;
        });
    },
    openAssignPaymetDialog(userId) {
      this.$emit("openAssignPaymetDialog", {
        userId: userId,
        groupId: this.id
      });
    },
    openAssignPaymentDialogInfo(userId) {
      this.$emit("openAssignPaymentDialogInfo", {
        userId: userId,
        groupId: this.id
      });
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog(val) {
      if (val == true) {
        this.getUsers();
      }
      this.$emit("closeDialog", null);
    }
  }
};
</script>