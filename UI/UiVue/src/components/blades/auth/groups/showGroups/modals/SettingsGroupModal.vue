<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="800px" scrollable>
        <v-card>
          <v-card-text style="max-height: 500px;">
            <v-tabs background-color="#212121" color="white" center-active dark>
              <v-tab>
                <v-icon left>mdi-tune</v-icon>
              </v-tab>
              <v-tab>
                <v-icon left>mdi-unfold-more-horizontal</v-icon>
              </v-tab>
              <v-tab>
                <v-icon left>mdi-information</v-icon>
              </v-tab>

              <v-tab-item>
                <v-card flat>
                  <EditGroup
                    @dialog="closeDialog"
                    @closeDialog="closeDialog"
                    @refreshGroups="refreshGroups"
                    :data="this.data"
                    @sendSnackFun="sendSnackFun"
                  ></EditGroup>
                </v-card>
              </v-tab-item>
              <v-tab-item>
                <v-card flat>
                  <v-card-text>
                    <editGroupLevel
                      @refreshGroups="refreshGroups"
                      @sendSnackFun="sendSnackFun"
                      :data="this.data"
                    ></editGroupLevel>
                  </v-card-text>
                </v-card>
              </v-tab-item>
              <v-tab-item>
                <v-card flat>
                  <v-card-text></v-card-text>
                </v-card>
              </v-tab-item>
            </v-tabs>
          </v-card-text>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
const EditGroup = () => import("../settingTabs/editGroup");
const EditGroupLevel = () => import("../settingTabs/editGroupLevel");
export default {
  components: {
    EditGroup,
    EditGroupLevel
  },
  props: {
    id: String,
    open: Boolean,
    data: Object
  },
  data() {
    return {
      dialog: false
    };
  },
  watch: {
    open(val) {
      this.dialog = val;
    },
    dialog(val) {
      this.$emit("showSettingsGroupDialogIfOpen", val);
    }
  },
  methods: {
    closeDialog() {
      this.dialog = false;
    },
    refreshGroups() {
      this.$emit("refreshGroups", null);
    },
    sendSnackFun(data) {
      this.$emit("snackbarActivateFun", null);
      this.$emit("sendSnackBarTextFun", data.text);
      this.$emit("snackbarColorFun", data.color);
    }
  }
};
</script>
