<template>
  <div>
    <v-sheet
      v-if="!complete"
      :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
      class="px-3 pt-3 pb-3"
    >
      <v-skeleton-loader class="mx-auto" type="table"></v-skeleton-loader>
    </v-sheet>
    <v-card v-else>
      <v-card-title>
        Users Table
        <v-spacer></v-spacer>
        <v-text-field v-model="search" label="Search" append-icon="search" single-line hide-details>
          <v-icon>search</v-icon>
        </v-text-field>
      </v-card-title>
      <v-data-table
        :loading="loadingDatatablePage"
        :headers="headers"
        :items="users"
        :search="search"
        :page.sync="page"
        :items-per-page="itemsPerPage"
        :server-items-length="serverItemLength"
        :footer-props="{
    'items-per-page-options': [10, 30,  50],
  }"
        @update:items-per-page="getItemPerPage"
      >
        <template v-slot:item.edit="{ item }">
          <v-chip color="green" dark class="mr-2" v-if="editPermission(item.role)">
            <v-icon small link @click="editItem(item.edit,item.role)">mdi-pencil</v-icon>
          </v-chip>
          <v-chip
            color="red"
            dark
            v-if="$hasPermissions.includes('deactive ' + item.role.toLowerCase())"
          >
            <v-icon small link @click="modal(item.edit)">mdi-account-remove</v-icon>
          </v-chip>
        </template>
      </v-data-table>
    </v-card>
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
          <v-form v-model="valid" ref="deactivateUserForm" @submit.prevent="deactivateUser">
            <v-card-title>Deactivate User</v-card-title>
            <v-divider></v-divider>
            <v-card-text class="mb-5" style="height: 150px;">
              <h3 class="mt-4" style="color:white">Write code: Deactivate</h3>
              <v-divider></v-divider>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-text-field
                v-model="confirmDeactivateCode"
                class="mt-5"
                :counter="10"
                :rules="[rules.required, rules.max10]"
                label="Confirm Code"
                required
              ></v-text-field>
            </v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="float-right" color="blue darken-1" text @click="closeDialog">Close</v-btn>
              <v-btn class="float-right" color="blue darken-1" text type="submit">Save</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>
    <v-snackbar v-model="snackBar">
      {{ snackBarText }}
      <v-btn color="pink" text @click="snackBar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  inject: ["theme"],
  created() {
    this.complete = false;
    this.getUsers();
  },

  data() {
    return {
      loadingDatatablePage: false,
      serverItemLength: 10,
      snackBar: false,
      snackBarText: "",
      confirmDeactivateCode: "",
      valid: false,
      dialog: false,
      dialogId: "",
      complete: false,
      search: "",
      page: 1,
      pageCount: 123,
      itemsPerPage: 10,
      pagination: {
        itemsLength: 102
      },
      headers: [
        {
          text: "Role",
          align: "left",
          sortable: true,
          value: "role"
        },
        { text: "FullName", value: "fullname" },
        { text: "Email", value: "email" },
        { text: "Username", value: "username" },
        { text: "Actions", value: "edit", sortable: false }
      ],
      users: [],
      rules: {
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters"
      }
    };
  },
  methods: {
    getUsers: function() {
      this.loadingDatatablePage = true;
      var app = this;
      this.axios
        .get("/api/users/", {
          params: {
            page: app.page,
            itemsPerPage: app.itemsPerPage,
            search: app.search
          }
        })
        .then(function(response) {
          app.users = [];
          for (let i = 0; i < response.data.users.data.length; i++) {
            app.users.push({
              role: response.data.users.data[i].role,
              fullname:
                response.data.users.data[i].name +
                " " +
                response.data.users.data[i].lastName,
              email: response.data.users.data[i].email,
              username: response.data.users.data[i].userName,
              edit: response.data.users.data[i].id
            });
            app.serverItemLength = response.data.usersLength;
          }
        })
        .then(function() {
          app.loadingDatatablePage = false;
          app.complete = true;
        })
        .catch(err => {
          app.snackBar = true;
          app.snackBarText = err.response.data;
          app.complete = true;
        });
    },
    editItem(id, role) {
      role = role.toLowerCase();
      this.$router.push({
        name: "Edit",
        params: { id: id, role: role }
      });
    },
    closeDialog() {
      this.dialog = false;
      this.confirmDeactivateCode = "";
      this.dialogId = "";
      this.$refs.deactivateUserForm.resetValidation();
    },
    modal(id) {
      this.dialog = true;
      this.dialogId = id;
    },
    deactivateUser() {
      if (this.$refs.deactivateUserForm.validate()) {
        if (this.confirmDeactivateCode.toUpperCase() == "DEACTIVATE") {
          var app = this;
          this.axios
            .delete("/api/users/:delete", {
              data: {
                id: app.dialogId
              }
            })
            .then(res => {
              app.dialog = false;
              app.confirmDeactivateCode = "";
              app.snackBar = true;
              app.snackBarText = res.data;
              app.getUsers();
            })
            .catch(error => {
              //handle error
              if (error.response.status === 403) {
                this.snackBar = true;
                this.snackBarText = error.response.data;
              }
            });
        } else {
          this.snackBar = true;
          this.snackBarText = "Incorrect Code";
        }
      }
    },
    getItemPerPage(val) {
      this.itemsPerPage = val;
      this.page = 1;
      this.getUsers();
    },
    editPermission(role) {
      role = role.toLowerCase();
      if (
        this.$hasPermissions.includes("edit-info " + role) ||
        this.$hasPermissions.includes("edit-username-email " + role) ||
        this.$hasPermissions.includes("edit-password " + role)
      ) {
        return true;
      } else {
        return false;
      }
    }
  },
  watch: {
    page(oldval, newVal) {
      if (oldval != newVal) {
        this.loadingDatatablePage = true;
        this.getUsers();
      }
    },
    search(oldVal) {
      this.search = oldVal;
      this.loadingDatatablePage = true;
      this.page = 1;
      this.getUsers();
    }
  }
};
</script>