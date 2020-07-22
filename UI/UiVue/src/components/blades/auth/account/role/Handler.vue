<template>
  <div>
    <v-sheet>
      <v-row>
        <v-col cols="8">
          <v-btn class="mx-2 col-4" dark x-large @click="openCreateRoleDialog">
            <v-icon dark>mdi-plus</v-icon>
          </v-btn>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row>
        <v-col cols="6">
          <v-card>
            <v-card-title>
              Roles Table
              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                label="Search"
                append-icon="search"
                single-line
                hide-details
              >
                <v-icon>search</v-icon>
              </v-text-field>
            </v-card-title>
            <v-data-table
              :loading="isLoadingRolesTable"
              :headers="headers"
              :items="roles"
              :search="search"
              :page.sync="page"
              :items-per-page="itemsPerPage"
              :footer-props="{ 'items-per-page-options': [5]}"
            >
              <template v-slot:item.edit="{ item }">
                <v-row>
                  <v-chip dark class="mr-2" :color="item.id == itemId ? 'green' : ''">
                    <v-icon small link @click="infoItem(item.id)">mdi-eye</v-icon>
                  </v-chip>
                  <v-chip dark class="mr-2">
                    <v-icon small link @click="deleteItem(item.id, item.name)">mdi-delete</v-icon>
                  </v-chip>
                </v-row>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-sheet class="px-3 ml-5 pb-5" color="black">
            <v-sheet style="background-color:#039BE5;" class="mb-3">
              <center>
                <h3 class="py-3">No Permission</h3>
              </center>
            </v-sheet>
            <v-row v-if="isLoadingNoPermission" justify="center">
              <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
            </v-row>
            <draggable :list="list1" group="people" style="max-height:500px;overflow-y: auto;">
              <v-chip class="mt-4 list-group-item" v-for="(element) in list1" :key="element.name">
                <h3 style="width:200px;">{{ element.name }}</h3>
              </v-chip>
            </draggable>
          </v-sheet>
        </v-col>
        <v-col cols="3">
          <v-sheet class="px-3 ml-5 pb-5" color="black">
            <v-sheet style="background-color:#039BE5;" class="mb-3">
              <center>
                <h3 class="py-3">Permissions</h3>
              </center>
            </v-sheet>
            <v-row v-if="isLoadingPermission" justify="center">
              <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
            </v-row>
            <draggable
              :list="list2"
              @change="log"
              group="people"
              style="max-height:500px;overflow-y: auto;"
            >
              <v-chip class="mt-4 list-group-item" v-for="(element) in list2" :key="element.name">
                <h3 style="width:200px;">{{ element.name }}</h3>
              </v-chip>
            </draggable>
          </v-sheet>
        </v-col>
      </v-row>
    </v-sheet>
    <CreateRoleDialog
      @snackBarFun="snackBarFun"
      :open="this.createRoleDialog.open"
      @closeCreateRoleDialog="closeCreateRoleDialog"
      @refreshTable="refreshTable"
    ></CreateRoleDialog>
    <DeleteRoleDialog
      @snackBarFun="snackBarFun"
      :open="this.deleteRoleDialog.open"
      :id="this.deleteRoleDialog.id"
      :name="this.deleteRoleDialog.name"
      @closeDeleteRoleDialog="closeDeleteRoleDialog"
      @refreshTable="refreshTable"
    ></DeleteRoleDialog>
    <SnackBar
      :snackbarActivate="this.snackbarActivate"
      :snackBarColor="this.snackBarColor"
      :sendSnackBarText="this.snackBarText"
    ></SnackBar>
  </div>
</template>
<script>
import draggable from "vuedraggable";
const CreateRoleDialog = () => import("./dialogs/CreateRoleDialog");
const DeleteRoleDialog = () => import("./dialogs/DeleteRoleDialog");
const SnackBar = () => import("./SnackBar");
export default {
  name: "two-lists",
  display: "Two Lists",
  order: 1,
  components: {
    draggable,
    CreateRoleDialog,
    SnackBar,
    DeleteRoleDialog
  },
  mounted() {
    this.getRoles();
  },
  data() {
    return {
      isLoadingNoPermission: false,
      isLoadingPermission: false,
      isLoadingRolesTable: false,
      snackbarActivate: false,
      snackBarColor: "",
      snackBarText: "",
      createRoleDialog: {
        open: false
      },
      deleteRoleDialog: {
        open: false,
        id: "",
        name: ""
      },
      itemId: "",
      search: "",
      dialog: false,
      page: 1,
      roles: [],
      itemsPerPage: 5,
      pagination: {
        itemsLength: 5
      },
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: true,
          value: "name"
        },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "edit", sortable: false }
      ],
      list1: [],
      list2: []
    };
  },
  methods: {
    refreshTable() {
      if (this.itemId != "") {
        let id = this.itemId;
        this.list1 = [];
        this.list2 = [];
        this.getRolePermissions(id);
        this.getRoleNoPermissions(id);
      }
      this.getRoles();
    },
    closeCreateRoleDialog() {
      this.createRoleDialog.open = false;
    },
    closeDeleteRoleDialog() {
      this.deleteRoleDialog.open = false;
    },
    deleteItem(id, name) {
      this.deleteRoleDialog.open = true;
      this.deleteRoleDialog.id = id;
      this.deleteRoleDialog.name = name;
    },
    log: function(evt) {
      console.log(evt);
      var app = this;
      if (evt.added) {
        this.axios
          .post("api/roles/:assign-permission", {
            role_id: app.itemId,
            permission_id: evt.added.element.id
          })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.axios
          .post("api/roles/:unassign-permission", {
            role_id: app.itemId,
            permission_id: evt.removed.element.id
          })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    snackBarFun(data) {
      this.snackbarActivate = !this.snackbarActivate;
      this.snackBarText = data.text;
      this.snackBarColor = data.color;
    },
    openCreateRoleDialog() {
      this.createRoleDialog.open = true;
    },
    getRoles() {
      this.isLoadingRolesTable = true;
      this.axios
        .get("api/roles")
        .then(response => {
          this.roles = [];
          this.roles = response.data;
          this.isLoadingRolesTable = false;
        })
        .catch(error => {
          console.log(error);
          this.isLoadingRolesTable = false;
        });
    },
    infoItem(id) {
      this.itemId = id;
      this.list1 = [];
      this.list2 = [];
      this.getRolePermissions(id);
      this.getRoleNoPermissions(id);
    },
    getRolePermissions(id) {
      this.isLoadingPermission = true;
      var app = this;
      this.axios
        .get("api/roles/:has-permissions", {
          params: {
            id: id
          }
        })
        .then(response => {
          app.isLoadingPermission = false;

          app.list2 = [];
          app.list2 = response.data;
        });
    },
    getRoleNoPermissions(id) {
      this.isLoadingNoPermission = true;
      var app = this;
      this.axios
        .get("api/roles/:has-not-permissions", {
          params: {
            id: id
          }
        })
        .then(response => {
          app.isLoadingNoPermission = false;
          app.list1 = [];
          app.list1 = response.data;
        });
    }
  }
};
</script>