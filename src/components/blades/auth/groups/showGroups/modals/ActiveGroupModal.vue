<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">
        <v-card>
          <v-form v-model="valid" ref="submitFormActiveGroup" @submit.prevent="submitForm">
            <v-card-title>
              <span class="headline">Activate Group</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="6">
                    <v-menu
                      ref="menu"
                      v-model="model.from"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="time"
                      transition="scale-transition"
                      offset-y
                      format="24hr"
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                          v-model="time"
                          label="Start from"
                          prepend-icon="access_time"
                          readonly
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        format="24hr"
                        v-if="model.from"
                        v-model="time"
                        full-width
                        @click:minute="$refs.menu.save(time)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                  <v-col>
                    <v-menu
                      ref="menu2"
                      v-model="model.to"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="time2"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                          v-model="time2"
                          label="Ends to"
                          prepend-icon="access_time"
                          readonly
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        format="24hr"
                        :min="this.time"
                        v-if="model.to"
                        v-model="time2"
                        full-width
                        @click:minute="$refs.menu2.save(time2)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn color="blue darken-1" text type="submit">Save</v-btn>
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
    dialogId: String,
    dialogVal: Boolean
  },
  watch: {
    dialogVal(val) {
      this.dialog = val;
    },
    dialog(val) {
      this.$emit("showActiveGroupDialogIfOpen", val);
    }
  },
  data() {
    return {
      model: {
        from: "",
        to: ""
      },
      time: new Date().toLocaleTimeString("en-GB", {
        hour: "2-digit",
        minute: "2-digit"
      }),
      time2: new Date().toLocaleTimeString("en-GB", {
        hour: "2-digit",
        minute: "2-digit"
      }),
      dialog: false,
      valid: false,
      rules: {
        nameIsTaken: "Name is already been taken",
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters",
        unsigned: v => v > 0 || "You cannot chose value lower than 0",
        maxNumber: v => v <= 100 || "You should chose number 100 or less"
      }
    };
  },
  methods: {
    submitForm() {
      var app = this;
      if (this.time == this.time2) {
        this.$emit("snackbarColorFun", "red darken-3");
        this.$emit("snackbarActivateFun", null);
        this.$emit(
          "sendSnackBarTextFun",
          "Start and end time must not be the same!"
        );
      } else {
        this.axios
          .post("api/groups/:active-group", {
            from: app.time,
            to: app.time2,
            group_id: app.dialogId
          })
          .then(response => {
            app.dialog = false;
            app.$emit("snackbarColorFun", "");
            app.$emit("snackbarActivateFun", null);
            app.$emit("sendSnackBarTextFun", response.data);
            app.$emit("refreshGroups", null);
          })
          .catch(error => {
            app.$emit("snackbarColorFun", "red darken-3");
            app.$emit("snackbarActivateFun", null);
            app.$emit("sendSnackBarTextFun", error.response.data);
          })
          .then(function() {});
      }
    }
  }
};
</script>