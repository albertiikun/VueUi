<template>
  <div>
    <v-sheet class="px-3">
      <v-row>
        <v-col cols="8">
          <v-btn class="mx-2 col-4" dark x-large @click="createGroupModal">
            <v-icon dark>mdi-plus</v-icon>
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
      <v-divider></v-divider>
      <v-row>
        <v-progress-linear v-if="isLoading" color="blue" height="4" indeterminate></v-progress-linear>
      </v-row>
      <v-row v-if="isLoading">
        <v-col cols="4" v-for="num in 6" :key="num">
          <v-skeleton-loader class="mx-auto" max-width="300" type="image"></v-skeleton-loader>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="4" v-for="group in groupList" :key="group.id" class="card">
          <GroupCard
            v-if="!isLoading"
            :groupName="group.name"
            :subject="group.subject"
            :subjectId="group.subjectId"
            :groupLevel="group.level"
            :groupId="group.id"
            @showUsers="showUsers"
            @assignUser="assignUser"
            @unAssignUser="unAssignUser"
            @activeGroup="activeGroup"
            @deactiveGroup="deactiveGroup"
            @settingsGroup="settingsGroup"
            :groupUsers="group.users"
            :studentLimit="group.studentLimit"
            :maxLevel="group.maxLevel"
            :isGroupActive="activatedGroups"
            :showDropDown="showDropDown"
          ></GroupCard>
        </v-col>
        <v-pagination class="mt-4" v-model="page" :length="this.pageLength"></v-pagination>
      </v-row>
      <ShowGroupUserModal
        :open="this.dialogShowUsers.open"
        :id="this.dialogShowUsers.id"
        @showGroupUsersDialogWatch="showGroupUsersDialogIfOpen"
      ></ShowGroupUserModal>
      <CreateGroupModal
        :dialogVal="dialogCreateGroup.open"
        @dialog="dialogCreateGroupWatch"
        @refreshGroups="refreshGroups"
      ></CreateGroupModal>
      <AssignUserModal
        :dialogVal="this.dialogAssignUser.open"
        @dialogAssignWatch="dialogAssignWatch"
        :dialogId="this.dialogAssignUser.id"
        @snackbarActivateFun="this.snackbarActivateFun"
        @sendSnackBarTextFun="this.sendSnackBarTextFun"
        @snackbarColorFun="this.snackbarColorFun"
        @refreshGroups="refreshGroups"
      ></AssignUserModal>
      <DeleteUserModal
        :open="this.dialogDeleteUsers.open"
        :id="this.dialogDeleteUsers.id"
        @showDeleteUsersDialogIfOpen="showDeleteUsersDialogIfOpen"
        @sendSnackBarTextFun="this.sendSnackBarTextFun"
        @snackbarActivateFun="this.snackbarActivateFun"
        @snackbarColorFun="this.snackbarColorFun"
        @refreshGroups="refreshGroups"
      ></DeleteUserModal>
      <ActiveGroupModal
        :dialogVal="this.dialogActiveGroup.open"
        :dialogId="this.dialogActiveGroup.id"
        @showActiveGroupDialogIfOpen="showActiveGroupDialogIfOpen"
        @refreshGroups="refreshGroups"
        @sendSnackBarTextFun="this.sendSnackBarTextFun"
        @snackbarActivateFun="this.snackbarActivateFun"
        @snackbarColorFun="this.snackbarColorFun"
      ></ActiveGroupModal>
      <DeactiveGroupModal
        :open="this.dialogDeactiveGroup.open"
        :id="this.dialogDeactiveGroup.id"
        @showDeactiveGroupDialogIfOpen="showDeactiveGroupDialogIfOpen"
        @refreshGroups="refreshGroups"
        @sendSnackBarTextFun="this.sendSnackBarTextFun"
        @snackbarActivateFun="this.snackbarActivateFun"
        @snackbarColorFun="this.snackbarColorFun"
      ></DeactiveGroupModal>
      <SettingsGroupModal
        :open="this.dialogSettingsGroup.open"
        :id="this.dialogSettingsGroup.id"
        :data="this.dialogSettingsGroup.data"
        @showSettingsGroupDialogIfOpen="showSettingsGroupDialogIfOpen"
        @refreshGroups="refreshGroups"
        @sendSnackBarTextFun="this.sendSnackBarTextFun"
        @snackbarActivateFun="this.snackbarActivateFun"
        @snackbarColorFun="this.snackbarColorFun"
      ></SettingsGroupModal>
      <Snackbar
        :snackbarActivate="this.snackbarActivate"
        :snackBarColor="this.snackBarColor"
        :sendSnackBarText="this.snackBarText"
      ></Snackbar>
    </v-sheet>
  </div>
</template>
<script>
const GroupCard = () => import("./GroupCard");
const ShowGroupUserModal = () => import("./modals/ShowGroupUserModal");
const CreateGroupModal = () => import("./modals/CreateGroupModal");
const AssignUserModal = () => import("./modals/AssignUserModal");
const Snackbar = () => import("../SnackBar");
const DeleteUserModal = () => import("./modals/DeleteUserModal");
const ActiveGroupModal = () => import("./modals/ActiveGroupModal");
const DeactiveGroupModal = () => import("./modals/DeactiveGroupModal");
const SettingsGroupModal = () => import("./modals/SettingsGroupModal");
export default {
  components: {
    GroupCard,
    ShowGroupUserModal,
    CreateGroupModal,
    AssignUserModal,
    Snackbar,
    DeleteUserModal,
    ActiveGroupModal,
    DeactiveGroupModal,
    SettingsGroupModal
  },
  data() {
    return {
      showDropDown: false,
      snackbarActivate: false,
      snackBarText: "",
      snackBarColor: "",
      dialogShowUsers: {
        open: false,
        id: null,
        watch: null
      },
      dialogDeleteUsers: {
        open: false,
        id: null,
        watch: null
      },
      dialogActiveGroup: {
        open: false,
        id: null,
        watch: null
      },
      dialogDeactiveGroup: {
        open: false,
        id: null,
        watch: null
      },
      dialogCreateGroup: {
        open: false,
        id: null,
        watch: null
      },
      dialogAssignUser: {
        open: false,
        id: null,
        watch: null
      },
      dialogSettingsGroup: {
        open: false,
        id: null,
        watch: null,
        data: null
      },
      search: "",
      isLoading: true,
      pageLength: 1,
      groupList: [],
      activatedGroups: [],
      page: 1
    };
  },
  mounted() {
    this.getActivatedGroups();
    this.getGroups();
  },
  created() {
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
  },
  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  },
  methods: {
    handleResize() {
      if (window.innerWidth < 1312) {
        this.showDropDown = true;
      } else {
        this.showDropDown = false;
      }
    },
    getGroups: function() {
      var app = this;
      this.axios
        .get("/api/groups/", {
          params: {
            page: app.page,
            search: app.search
          }
        })
        .then(function(response) {
          app.groupList = [];
          app.pageLength = response.data.last_page;
          for (let i = 0; i < response.data.data.length; i++) {
            app.groupList.push(response.data.data[i]);
          }
          app.isLoading = false;
        });
    },
    getActivatedGroups() {
      var app = this;
      this.axios.get("api/groups/:actvated-groups").then(function(response) {
        app.activatedGroups = [];
        for (let i = 0; i < response.data.length; i++) {
          app.activatedGroups.push(response.data[i]);
        }
      });
    },
    showUsers(id) {
      this.dialogShowUsers.id = id;
      this.dialogShowUsers.open = true;
    },
    showGroupUsersDialogIfOpen(val) {
      this.dialogShowUsers.open = val;
    },
    showDeleteUsersDialogIfOpen(val) {
      this.dialogDeleteUsers.open = val;
    },
    showActiveGroupDialogIfOpen(val) {
      this.dialogActiveGroup.open = val;
    },
    showDeactiveGroupDialogIfOpen(val) {
      this.dialogDeactiveGroup.open = val;
    },
    showSettingsGroupDialogIfOpen(val) {
      this.dialogSettingsGroup.open = val;
    },
    createGroupModal() {
      this.dialogCreateGroup.open = true;
    },
    dialogCreateGroupWatch(val) {
      this.dialogCreateGroup.open = val;
    },
    refreshGroups() {
      this.isLoading = true;
      this.getGroups();
      this.getActivatedGroups();
    },
    assignUser(id) {
      this.dialogAssignUser.id = id;
      this.dialogAssignUser.open = true;
    },
    unAssignUser(id) {
      this.dialogDeleteUsers.id = id;
      this.dialogDeleteUsers.open = true;
    },
    activeGroup(id) {
      this.dialogActiveGroup.id = id;
      this.dialogActiveGroup.open = true;
    },
    deactiveGroup(id) {
      this.dialogDeactiveGroup.id = id;
      this.dialogDeactiveGroup.open = true;
    },
    settingsGroup(data) {
      this.dialogSettingsGroup.data = data;
      this.dialogSettingsGroup.id = data.groupId;
      this.dialogSettingsGroup.open = true;
    },
    dialogAssignWatch(val) {
      this.dialogAssignUser.open = val;
    },
    snackbarActivateFun() {
      this.snackbarActivate = !this.snackbarActivate;
    },
    sendSnackBarTextFun(val) {
      this.snackBarText = val;
    },
    snackbarColorFun(val) {
      this.snackBarColor = val;
    }
  },
  watch: {
    page() {
      this.isLoading = true;
      this.getGroups();
    },
    search() {
      this.page = 1;
      this.isLoading = true;
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