<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="400px" scrollable>
        <v-card>
          <v-card-title>
            <span class="headline">Are you sure ?</span>
          </v-card-title>
          <v-card-text style="max-height: 500px;"></v-card-text>

          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="red darken-1" text @click="submitDeactiveGroup">Submit</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  props: {
    id: String,
    open: Boolean
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
      this.$emit("showDeactiveGroupDialogIfOpen", val);
    }
  },
  methods: {
    submitDeactiveGroup() {
      var app = this;
      this.axios
        .post("api/groups/:deactivate-group", {
          group_id: app.id
        })
        .then(response => {
          app.$emit("refreshGroups", null);
          app.$emit("snackbarColorFun", "");
          app.$emit("snackbarActivateFun", null);
          app.$emit("sendSnackBarTextFun", response.data);
        })
        .catch(error => {
          app.$emit("snackbarColorFun", "red darken-3");
          app.$emit("snackbarActivateFun", null);
          app.$emit("sendSnackBarTextFun", error.response.data);
        })
        .then(function() {
          app.dialog = false;
        });
    }
  }
};
</script>