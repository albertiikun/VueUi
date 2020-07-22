<template>
  <div>
    <v-progress-linear color="blue" v-if="isLoading" height="4" indeterminate></v-progress-linear>
    <v-row v-if="isLoading">
      <v-col cols="4" v-for="num in 6" :key="num">
        <v-skeleton-loader class="mx-auto" max-width="300" type="image"></v-skeleton-loader>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="4" v-for="group in groupList" :key="group.id" class="card">
        <GroupCard :group="group" v-if="!isLoading" @openUsersDialog="openUsersDialog"></GroupCard>
      </v-col>
    </v-row>
    <ShowUsersDialog
      @openAssignPaymentDialogInfo="openAssignPaymentDialogInfo"
      @openAssignPaymetDialog="openAssignPaymetDialog"
      :open="showUsersDialog.open"
      :id="showUsersDialog.id"
      @closeDialog="closeDialog"
    ></ShowUsersDialog>
    <AssignPaymetDialog
      @closeAssignPaymetDialog="closeAssignPaymetDialog"
      :open="assignPaymentDialog.open"
      :ids="assignPaymentDialog.ids"
      @snackBarFun="snackBarFun"
    ></AssignPaymetDialog>
    <AssignPaymentInfoDialog
      @snackBarFun="snackBarFun"
      @closeAssignPaymetInfoDialog="closeAssignPaymetInfoDialog"
      :open="assignPaymentInfoDialog.open"
      :ids="assignPaymentInfoDialog.ids"
    ></AssignPaymentInfoDialog>
  </div>
</template>
<script>
const GroupCard = () => import("./GroupCard");
const ShowUsersDialog = () => import("./dialogs/ShowUsersDialog");
const AssignPaymetDialog = () => import("./dialogs/AssignPaymetDialog");
const AssignPaymentInfoDialog = () =>
  import("./dialogs/AssignPaymentInfoDialog");

export default {
  props: {
    search: String,
    page: Number
  },
  components: {
    GroupCard,
    ShowUsersDialog,
    AssignPaymetDialog,
    AssignPaymentInfoDialog
  },
  mounted() {
    this.getGroups();
  },
  data() {
    return {
      groupList: [],
      pageVal: 1,
      isLoading: true,
      showUsersDialog: {
        open: false,
        id: ""
      },
      assignPaymentDialog: {
        open: false,
        ids: null
      },
      assignPaymentInfoDialog: {
        open: false,
        ids: null
      }
    };
  },
  methods: {
    getGroups() {
      var app = this;
      this.axios
        .get("api/payments/:get-by-groups", {
          params: {
            page: app.pageVal,
            search: app.search
          }
        })
        .then(response => {
          app.groupList = [];
          app.$emit("pages", response.data.last_page);
          for (let i = 0; i < response.data.data.length; i++) {
            app.groupList.push(response.data.data[i]);
          }
          app.isLoading = false;
          app.$emit("groupList", app.groupList);
        })
        .catch(error => {
          console.log(error);
        });
    },
    openUsersDialog(val) {
      this.showUsersDialog.open = true;
      this.showUsersDialog.id = val;
    },
    closeDialog() {
      this.showUsersDialog.open = false;
    },
    openAssignPaymetDialog(data) {
      this.assignPaymentDialog.open = true;
      this.assignPaymentDialog.ids = data;
    },
    openAssignPaymentDialogInfo(data) {
      this.assignPaymentInfoDialog.open = true;
      this.assignPaymentInfoDialog.ids = data;
    },
    closeAssignPaymetDialog() {
      this.assignPaymentDialog.open = false;
    },
    closeAssignPaymetInfoDialog() {
      this.assignPaymentInfoDialog.open = false;
    },
    snackBarFun(data) {
      this.$emit("snackBarFun", data);
    }
  },
  watch: {
    search() {
      this.getGroups();
    },
    page() {
      this.isLoading = true;
      this.pageVal = this.page;
      this.getGroups();
    }
  }
};
</script>

<style lang="css">
.card {
  min-width: 250px !important;
}

@media screen and (max-width: 523px) {
  .row {
    justify-content: center !important;
  }
}
</style>