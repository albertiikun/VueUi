<template>
  <div>
    <v-card :color="isGroupActive.includes(groupId) ? 'green darken-2':'black'" dark>
      <v-card-title>
        <v-icon large left>mdi-format-color-fill</v-icon>
        <span class="title font-weight-light">{{groupName}}</span>
      </v-card-title>
      <v-card-text>
        Group Subject: {{subject}}
        <br />
        Group Level: {{groupLevel}} / {{maxLevel}}
        <br />
        Student Limit: {{groupUsers}} / {{studentLimit}}
      </v-card-text>
      <v-card-actions>
        <v-list-item class="grow">
          <v-row align="center" justify="end">
            <div v-if="!this.showDropDown">
              <v-btn
                color="primary"
                small
                dark
                class="mr-2"
                v-if="isGroupActive.includes(groupId)"
                @click="DeactiveGroupDialog"
              >
                <v-icon>mdi-arrow-down</v-icon>
              </v-btn>
              <v-btn
                v-if="!isGroupActive.includes(groupId)"
                color="primary"
                small
                dark
                class="mr-2"
                @click="ActiveGroupDialog"
              >
                <v-icon>mdi-arrow-up</v-icon>
              </v-btn>

              <v-btn
                v-if="isGroupActive.includes(groupId)"
                color="primary"
                small
                dark
                class="mr-2"
                @click="ShowUsersDialog"
              >
                <v-icon>mdi-account-group</v-icon>
              </v-btn>
              <v-btn color="primary" small dark class="mr-2" @click="AssignUserDialog">
                <v-icon>mdi-account-plus</v-icon>
              </v-btn>
              <v-btn color="primary" small dark class="mr-2" @click="UnAssignUserDialog">
                <v-icon>mdi-account-minus</v-icon>
              </v-btn>
              <v-btn color="primary" small dark class="mr-2" @click="SettingsGroupDialog">
                <v-icon>mdi-cog</v-icon>
              </v-btn>
            </div>
            <v-menu top close-on-content-click v-if="this.showDropDown">
              <template v-slot:activator="{ on }">
                <v-btn color="primary" v-on="on">
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>

              <v-list>
                <v-list-item v-if="isGroupActive.includes(groupId)" @click="DeactiveGroupDialog">
                  <v-list-item-title>
                    <v-icon>mdi-arrow-down</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="ActiveGroupDialog" v-if="!isGroupActive.includes(groupId)">
                  <v-list-item-title>
                    <v-icon>mdi-arrow-up</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="ShowUsersDialog" v-if="isGroupActive.includes(groupId)">
                  <v-list-item-title>
                    <v-icon>mdi-account-group</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="AssignUserDialog">
                  <v-list-item-title>
                    <v-icon>mdi-account-plus</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="UnAssignUserDialog">
                  <v-list-item-title>
                    <v-icon>mdi-account-minus</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="SettingsGroupDialog">
                  <v-list-item-title>
                    <v-icon>mdi-cog</v-icon>
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-row>
        </v-list-item>
      </v-card-actions>
    </v-card>
  </div>
</template>
<script>
export default {
  props: {
    groupName: String,
    groupLevel: Number,
    groupId: String,
    subject: String,
    subjectId: String,
    groupUsers: Number,
    studentLimit: Number,
    maxLevel: Number,
    isGroupActive: Array,
    showDropDown: Boolean
  },
  methods: {
    ShowUsersDialog() {
      this.$emit("showUsers", this.groupId);
    },
    AssignUserDialog() {
      this.$emit("assignUser", this.groupId);
    },
    UnAssignUserDialog() {
      this.$emit("unAssignUser", this.groupId);
    },
    ActiveGroupDialog() {
      this.$emit("activeGroup", this.groupId);
    },
    DeactiveGroupDialog() {
      this.$emit("deactiveGroup", this.groupId);
    },
    SettingsGroupDialog() {
      var data = {
        groupId: this.groupId,
        groupName: this.groupName,
        groupLevel: this.groupLevel,
        studentLimit: this.studentLimit,
        maxLevel: this.maxLevel,
        subject: this.subject,
        subjectId: this.subjectId
      };
      this.$emit("settingsGroup", data);
    }
  }
};
</script>
<style lang="css">
.activeGroup {
  background-color: green !important;
}
</style>