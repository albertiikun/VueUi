<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
          <v-form v-model="valid" ref="createRoleForm" @submit.prevent="submit">
            <v-card-title>Create Role</v-card-title>
            <v-divider></v-divider>
            <v-card-text class="mb-5" style="height: 150px;">
              <v-row justify="center">
                <v-col cols="6">
                  <v-text-field
                    v-model="model.name"
                    class="mt-5"
                    :counter="100"
                    :rules="[rules.required, this.isTaken ? rules.nameIsTaken : true]"
                    label="Role Name"
                    required
                    @click="isTaken = false"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="float-right" color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn
                class="float-right"
                color="blue darken-1"
                text
                type="submit"
                :loading="isLoadingSubmit"
              >Save</v-btn>
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
    open: Boolean
  },
  data() {
    return {
      model: {
        name: ""
      },
      isTaken: false,
      isLoadingSubmit: false,
      dialog: false,
      valid: false,
      rules: {
        nameIsTaken: "Name is already been taken",
        required: v => !!v || "This field is required"
      }
    };
  },
  methods: {
    submit() {
      if (this.$refs.createRoleForm.validate()) {
        this.isLoadingSubmit = true;
        var app = this;
        this.axios
          .post("api/roles/:register", {
            name: app.model.name
          })
          .then(response => {
            app.dialog = false;
            app.model.name = "";
            app.isLoadingSubmit = false;

            app.$emit("snackBarFun", {
              color: "",
              text: response.data
            });
            app.$emit("refreshTable", null);
          })
          .catch(error => {
            app.isLoadingSubmit = false;
            app.$emit("snackBarFun", {
              color: "red darken-3",
              text: error.response.data["name"][0]
            });
          });
      }
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog() {
      this.$emit("closeCreateRoleDialog", null);
    }
  }
};
</script>