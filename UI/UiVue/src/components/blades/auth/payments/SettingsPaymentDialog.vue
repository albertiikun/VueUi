<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition">
        <v-card tile>
          <v-toolbar dark>
            <v-btn icon dark @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Payments</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-container>
              <div>
                <v-card>
                  <v-card-title>
                    Payments Table
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
                    :loading="isLoading"
                    :headers="headers"
                    :items="payments"
                    :search="search"
                    :page.sync="page"
                    :items-per-page="itemsPerPage"
                    :server-items-length="serverItemLength"
                    :footer-props="{
    'items-per-page-options': [10],
  }"
                    @update:items-per-page="getItemPerPage"
                  >
                    <template v-slot:item.edit="{ item }">
                      <v-chip color="green" dark class="mr-2">
                        <v-icon small link @click="editItem(item.edit)">mdi-pencil</v-icon>
                      </v-chip>
                      <v-chip color="red" dark>
                        <v-icon small link @click="modalDelete(item.edit)">mdi-delete</v-icon>
                      </v-chip>
                    </template>
                  </v-data-table>
                </v-card>
              </div>
            </v-container>
          </v-card-text>
          <a @click="dialog = false">
            <v-bottom-navigation
              style="position:absolute; bottom:0;"
              background-color="blue darken-1"
            >
              <span class="mt-4">Close</span>
            </v-bottom-navigation>
          </a>
        </v-card>
      </v-dialog>
    </v-row>
    <EditPayment
      @snackBarFun="snackBarFun"
      @refreshPayments="refreshPayments"
      :open="editModal.open"
      :id="editModal.id"
      @closeEditDialog="closeEditDialog"
      :paymentSchedule="paymentSchedule"
      :groups="groups"
    ></EditPayment>
    <DeletePayment
      :open="this.deleteModal.open"
      :id="this.deleteModal.id"
      @closeDeleteModal="closeDeleteModal"
      @refreshPayments="refreshPayments"
      @snackBarFun="snackBarFun"
    ></DeletePayment>
  </div>
</template>
<script>
const EditPayment = () => import("./settingPayments/EditPayment");
const DeletePayment = () => import("./settingPayments/DeletePayment");
export default {
  props: {
    open: Boolean,
    paymentSchedule: Array,
    groups: Array
  },
  components: {
    EditPayment,
    DeletePayment
  },
  mounted() {
    this.getPayments();
  },

  data() {
    return {
      isLoading: false,
      valid: false,
      dialog: false,
      dialogId: "",
      complete: false,
      search: "",
      page: 1,
      itemsPerPage: 10,
      serverItemLength: 0,
      pagination: {
        itemsLength: 102
      },
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: true,
          value: "name"
        },
        { text: "Group Name", value: "groupName" },
        { text: "Price", value: "price" },
        { text: "Schedule", value: "schedule" },
        { text: "Created At", value: "createdAt" },
        { text: "Updated At", value: "updatedAt" },
        { text: "Actions", value: "edit", sortable: false }
      ],
      payments: [],
      editModal: {
        open: false,
        id: ""
      },
      deleteModal: {
        open: false,
        id: ""
      }
    };
  },
  methods: {
    getPayments() {
      this.isLoading = true;
      var app = this;

      this.axios
        .get("api/payments", {
          params: {
            page: app.page,
            itemsPerPage: app.itemsPerPage,
            search: app.search
          }
        })
        .then(response => {
          app.payments = [];
          for (let i = 0; i < response.data.data.length; i++) {
            app.payments.push({
              name: response.data.data[i].name,
              groupName: response.data.data[i].group,
              price: response.data.data[i].price,
              schedule: response.data.data[i].schedule,
              createdAt: response.data.data[i].created_at,
              updatedAt: response.data.data[i].updated_at,
              edit: response.data.data[i].id
            });
          }
          app.serverItemLength = response.data.total;
          app.isLoading = false;
        });
    },
    refreshPayments() {
      this.getPayments();
    },
    getItemPerPage(val) {
      this.itemsPerPage = val;
      this.page = 1;
      this.getPayments();
    },
    editItem(id) {
      this.editModal.open = true;
      this.editModal.id = id;
    },
    closeEditDialog() {
      this.editModal.open = false;
    },
    modalDelete(id) {
      this.deleteModal.open = true;
      this.deleteModal.id = id;
    },
    closeDeleteModal() {
      this.deleteModal.open = false;
    },
    snackBarFun(data) {
      this.$emit("snackBarFun", data);
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog(val) {
      if (val === true) {
        this.getPayments();
      }
      this.$emit("closeDialog", null);
    },
    search(oldVal) {
      this.search = oldVal;
      this.loadingDatatablePage = true;
      this.page = 1;
      this.getPayments();
    }
  }
};
</script>