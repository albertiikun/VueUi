<template>
  <div>
    <v-container>
      <v-sheet class="px-3">
        <v-container>
          <v-row>
            <v-col cols="8">
              <v-btn class="mx-2 col-4" dark x-large @click="openCreatePaymentDialog">
                <v-icon dark>mdi-plus</v-icon>
              </v-btn>
              <v-btn class="mx-2 col-4" dark x-large @click="openEditPaymentDialog">
                <v-icon dark>mdi-cog</v-icon>
              </v-btn>
            </v-col>
            <v-col cols="4">
              <v-text-field
                v-model="search"
                label="Search"
                append-icon="search"
                single-line
                hide-details
                solo
              >
                <v-icon>search</v-icon>
              </v-text-field>
            </v-col>
          </v-row>
          <v-row justify="center">
            <v-tabs background-color="#212121" color="white" center-active dark>
              <v-tab>
                <v-icon left>mdi-tune</v-icon>Show by group
              </v-tab>
              <v-tab>
                <v-icon left>mdi-unfold-more-horizontal</v-icon>Show all
              </v-tab>
              <v-tab>
                <v-icon left>mdi-information</v-icon>Show paid
              </v-tab>
              <v-tab>
                <v-icon left>mdi-information</v-icon>Show not paid
              </v-tab>

              <v-tab-item>
                <v-card flat>
                  <ShowByGroupsHandler
                    :search="this.search"
                    @pages="pages"
                    :page="this.page"
                    @groupList="groupList"
                    @snackBarFun="snackBarFun"
                  ></ShowByGroupsHandler>
                </v-card>
              </v-tab-item>

              <v-tab-item>
                <v-card flat>
                  <v-card-text></v-card-text>
                </v-card>
              </v-tab-item>

              <v-tab-item>
                <v-card flat>
                  <v-card-text></v-card-text>
                </v-card>
              </v-tab-item>

              <v-tab-item>
                <v-card flat>
                  <v-card-text></v-card-text>
                </v-card>
              </v-tab-item>
            </v-tabs>
            <v-pagination class="mt-4" v-model="page" :length="this.pageLength"></v-pagination>
          </v-row>
        </v-container>
      </v-sheet>
    </v-container>
    <CreatePaymentDialog
      @snackBarFun="snackBarFun"
      :open="this.createPaymentDialog.open"
      @closeDialog="closeDialogCreate"
      :groups="this.groups"
      :paymentSchedule="this.paymentSchedule"
    ></CreatePaymentDialog>
    <SettingsPaymentDialog
      @snackBarFun="snackBarFun"
      :groups="this.groups"
      :open="this.editPaymentDialog.open"
      @closeDialog="closeDialogEdit"
      :paymentSchedule="this.paymentSchedule"
    ></SettingsPaymentDialog>
    <SnackBar
      :snackbarActivate="this.snackbarActivate"
      :snackBarColor="this.snackBarColor"
      :sendSnackBarText="this.snackBarText"
    ></SnackBar>
  </div>
</template>
<script>
const ShowByGroupsHandler = () =>
  import("./show/showByGroups/ShowByGroupsHandler");
const CreatePaymentDialog = () => import("./CreatePaymentDialog");
const SettingsPaymentDialog = () => import("./SettingsPaymentDialog");
const SnackBar = () => import("./SnackBar");
export default {
  mounted() {
    this.getPaymentSchedule();
  },
  components: {
    ShowByGroupsHandler,
    CreatePaymentDialog,
    SettingsPaymentDialog,
    SnackBar
  },
  data() {
    return {
      snackbarActivate: false,
      snackBarColor: "",
      snackBarText: "",
      groups: [],
      search: "",
      pageLength: 1,
      page: 1,
      paymentSchedule: [],
      createPaymentDialog: {
        open: false
      },
      editPaymentDialog: {
        open: false
      }
    };
  },
  methods: {
    pages(val) {
      this.pageLength = val;
    },
    pageVal(val) {
      this.page = val;
    },
    openCreatePaymentDialog() {
      this.createPaymentDialog.open = true;
    },
    openEditPaymentDialog() {
      this.editPaymentDialog.open = true;
    },
    closeDialogCreate() {
      this.createPaymentDialog.open = false;
    },
    closeDialogEdit() {
      this.editPaymentDialog.open = false;
    },
    groupList(data) {
      this.groups = data;
    },
    snackBarFun(data) {
      this.snackbarActivate = !this.snackbarActivate;
      this.snackBarText = data.text;
      this.snackBarColor = data.color;
    },
    getPaymentSchedule() {
      var app = this;
      this.axios.get("api/payments/:payment-schedule").then(response => {
        app.paymentSchedule = [];
        for (let i = 0; i < response.data.length; i++) {
          app.paymentSchedule.push(response.data[i]);
        }
      });
    }
  }
};
</script>