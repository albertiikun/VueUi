<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition">
        <v-card>
          <v-toolbar dark>
            <v-btn icon dark @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Payment Info</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-row>
              <v-col cols="6">
                <v-card class="mt-1">
                  <v-card-title>
                    Assigned Table
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
                    :loading="isLoadingTable"
                    :headers="headers"
                    :items="payments"
                    :search="search"
                    :page.sync="page"
                    :items-per-page="itemsPerPage"
                    :footer-props="{ 'items-per-page-options': [10]}"
                    @update:items-per-page="getItemPerPage"
                  >
                    <template v-slot:item.edit="{ item }">
                      <v-row>
                        <v-chip dark class="mr-2" :color="item.id == info.Id ? 'green' : ''">
                          <v-icon small link @click="infoItem(item.id)">mdi-eye</v-icon>
                        </v-chip>
                        <v-chip dark :color="item.paymentsTodo ? 'red' : ''">
                          <span
                            v-if="item.paymentsTodo"
                            style="width:15px; text-align:center;"
                          >{{item.paymentsTodo}}</span>
                          <v-icon v-else small link @click="infoItem(item.id)">mdi-check</v-icon>
                        </v-chip>
                      </v-row>
                    </template>
                  </v-data-table>
                </v-card>
              </v-col>
              <v-col cols="6" class="mt-1">
                <v-card v-if="info.show">
                  <AssignPaymentPanel :id="this.info.Id" @refreshUserPayment="refreshUserPayment"></AssignPaymentPanel>
                </v-card>
              </v-col>
            </v-row>
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
  </div>
</template>
<script>
const AssignPaymentPanel = () =>
  import("./AssignPaymentInfoPanel/AssignPaymentPanel");
export default {
  components: {
    AssignPaymentPanel
  },
  props: {
    open: Boolean,
    ids: Object
  },
  data() {
    return {
      isLoadingTable: false,
      info: {
        Id: "",
        show: false
      },
      search: "",
      dialog: false,
      payments: [],
      page: 1,
      itemsPerPage: 10,
      pagination: {
        itemsLength: 10
      },
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: true,
          value: "name"
        },
        { text: "Price", value: "price" },
        { text: "Schedule", value: "schedule" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "edit", sortable: false }
      ]
    };
  },
  methods: {
    getItemPerPage() {},
    infoItem(id) {
      this.info.Id = id;
    },
    modalDelete() {},
    refreshUserPayment() {
      this.getAssignedPayments();
    },
    getAssignedPayments() {
      this.isLoadingTable = true;
      var app = this;
      this.axios
        .get("api/payments/:user-payments-group-id", {
          params: {
            user_id: app.ids.userId,
            group_id: app.ids.groupId
          }
        })
        .then(response => {
          app.isLoadingTable = false;
          app.payments = [];
          app.payments = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },

  watch: {
    dialog(val) {
      if (val == true) {
        this.info.show = true;
        this.info.Id = "";
        this.getAssignedPayments();
      } else {
        this.info.show = false;
        this.info.Id = "";
      }
      this.$emit("closeAssignPaymetInfoDialog", null);
    },
    open() {
      this.dialog = true;
    },
    "ids.userId": function() {
      this.payments = [];
    }
  }
};
</script>