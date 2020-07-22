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
          <v-chip
            color="green"
            dark
            class="mr-2"
            v-if="$hasPermissions.includes('active ' + item.role.toLowerCase())"
          >
            <v-icon small link @click="openActivateDialog(item.edit)">mdi-account-check</v-icon>
          </v-chip>
          <v-chip
            color="red"
            dark
            v-if="$hasPermissions.includes('delete ' + item.role.toLowerCase())"
          >
            <v-icon small link @click="openDeleteDialog(item.edit)">mdi-delete</v-icon>
          </v-chip>
        </template>
      </v-data-table>
    </v-card>
    <DeleteModal
      :dialog="deleteDialog"
      :dialogId="this.dialogId"
      @refreshUsers="refreshUsersFromDeleteModal"
    ></DeleteModal>
    <ActivateModal
      :dialog="activateDialog"
      :dialogId="this.dialogId"
      @refreshUsers="refreshUsersFromDeleteModal"
    ></ActivateModal>
  </div>
</template>
<script>
import ActivateModal from "./ActivateModal";
import DeleteModal from "./DeleteModal";
export default {
  components: {
    DeleteModal,
    ActivateModal
  },
  inject: ["theme"],
  mounted() {
    this.getUsers();
  },
  data() {
    return {
      loadingDatatablePage: false,
      serverItemLength: 10,
      deleteDialog: false,
      activateDialog: false,
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
        { text: "Country", value: "country" },
        { text: "City", value: "city" },
        { text: "Address", value: "address" },
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
      var app = this;
      this.axios
        .get("/api/users/:deleted", {
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
              country: response.data.users.data[i].country,
              city: response.data.users.data[i].city,
              edit: response.data.users.data[i].id
            });
            app.serverItemLength = response.data.usersLength;
          }
        })
        .then(function() {
          app.complete = true;
          app.loadingDatatablePage = false;
        })
        .catch(function() {
          app.complete = true;
        });
    },
    getItemPerPage(val) {
      this.complete = false;
      this.itemsPerPage = val;
      this.page = 1;
      this.getUsers();
    },
    openDeleteDialog(id) {
      this.deleteDialog = !this.deleteDialog;
      this.dialogId = id;
    },
    openActivateDialog(id) {
      this.activateDialog = !this.activateDialog;
      this.dialogId = id;
    },

    refreshUsersFromDeleteModal() {
      this.complete = false;
      this.getUsers();
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