<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">
        <v-card>
          <v-form v-model="valid" ref="submitFormAssign" @submit.prevent="submitForm">
            <v-card-title>
              <span class="headline">Assign user to group</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-autocomplete
                  :loading="isLoading"
                  v-model="selectedVal"
                  :items="users"
                  :rules="[rules.required]"
                  filled
                  color="blue-grey lighten-2"
                  label="Select"
                  item-text="name"
                  item-value="id"
                  multiple
                  :search-input.sync="search"
                >
                  <template v-slot:selection="data">
                    <v-chip
                      v-bind="data.attrs"
                      :input-value="data.selected"
                      close
                      @click="data.select"
                      @click:close="remove(data.item)"
                    >{{ data.item.name }}</v-chip>
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn color="blue darken-1" text :loading="isLoadingSubmit" type="submit">Submit</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  props: {
    dialogVal: Boolean,
    dialogId: String
  },
  data() {
    return {
      isLoadingSubmit: false,
      isLoading: false,
      valid: false,
      selectedVal: [],
      dialog: false,
      search: null,
      rules: {
        required: v => !!v || "This field is required"
      },
      model: {
        name: ""
      },
      users: []
    };
  },
  watch: {
    dialogVal(val) {
      this.dialog = val;
    },
    dialog(val) {
      if (val == false) {
        this.selectedVal = [];
      }
      this.$emit("dialogAssignWatch", val);
    },
    search() {
      this.getUsers();
    }
  },
  methods: {
    remove(item) {
      const index = this.selectedVal.indexOf(item.name);
      if (index >= 0) this.selectedVal.splice(index, 1);
    },
    getUsers() {
      this.isLoading = true;
      var app = this;
      this.axios
        .get("api/groups/:users-to-assign", {
          params: {
            group_id: app.dialogId,
            search: app.search
          }
        })
        .then(response => {
          app.isLoading = false;

          for (let i = 0; i < response.data.length; i++) {
            app.users.push({
              name: response.data[i].name + " " + response.data[i].lastName,
              id: response.data[i].id
            });
          }
        })
        .catch(function() {
          app.isLoading = false;
        });
    },
    submitForm() {
      if (this.selectedVal.length == 0) {
        this.$emit("snackbarColorFun", "red darken-3");
        this.$emit("snackbarActivateFun", null);
        this.$emit("sendSnackBarTextFun", "Field is required!");
      } else {
        this.isLoadingSubmit = true;
        var app = this;
        this.axios
          .post("api/groups/:add-user", {
            group_id: app.dialogId,
            user_id: app.selectedVal
          })
          .then(response => {
            app.users = [];
            app.isLoadingSubmit = false;
            app.dialog = false;
            app.$emit("refreshGroups", null);
            this.$emit("snackbarColorFun", "");
            this.$emit("snackbarActivateFun", null);
            this.$emit("sendSnackBarTextFun", response.data);
          })
          .catch(err => {
            app.isLoadingSubmit = false;
            this.$emit("snackbarColorFun", "red darken-3");
            this.$emit("snackbarActivateFun", null);
            this.$emit("sendSnackBarTextFun", err.response.data);
          });
      }
    }
  }
};
</script>