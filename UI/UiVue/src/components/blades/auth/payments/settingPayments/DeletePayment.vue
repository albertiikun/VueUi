<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="deleteDialog" persistent max-width="400px">
        <v-card>
          <v-form v-model="valid" ref="deleteUserForm" @submit.prevent="deleteUser">
            <v-card-title>Delete Payment</v-card-title>
            <v-divider></v-divider>
            <v-card-text class="mb-5" style="height: 150px;">
              <h3 class="mt-4" style="color:white">Write code: Delete</h3>
              <v-divider></v-divider>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
              <v-text-field
                v-model="confirmDeleteCode"
                class="mt-5"
                :counter="10"
                :rules="[rules.required, rules.max10]"
                label="Confirm Code"
                required
              ></v-text-field>
            </v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                class="float-right"
                color="blue darken-1"
                text
                @click="deleteDialog = false"
              >Close</v-btn>
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
    open: Boolean,
    id: String
  },
  data() {
    return {
      snackbarActivate: false,
      snackBarText: "",
      deleteDialog: false,
      confirmDeleteCode: "",
      isLoadingSubmit: false,
      valid: false,
      rules: {
        required: v => !!v || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters"
      }
    };
  },
  methods: {
    deleteUser() {
      if (this.$refs.deleteUserForm.validate()) {
        if (this.confirmDeleteCode.toUpperCase() == "DELETE") {
          this.isLoadingSubmit = true;
          var app = this;
          this.axios
            .delete("api/payments/:delete", {
              data: {
                id: app.id
              }
            })
            .then(response => {
              app.isLoadingSubmit = false;

              app.deleteDialog = false;
              app.confirmDeleteCode = "";
              app.$emit("refreshPayments", null);
              app.$emit("snackBarFun", {
                color: "",
                text: response.data
              });
            })
            .catch(error => {
              app.isLoadingSubmit = false;
              app.$emit("snackBarFun", {
                color: "red darken-3",
                text: error.response.data
              });
            });
        } else {
          this.$emit("snackBarFun", {
            color: "red darken-3",
            text: "Code you entered dosen't match"
          });
        }
      }
    }
  },
  watch: {
    deleteDialog: function() {
      this.$emit("closeDeleteModal", null);
    },
    open() {
      this.deleteDialog = true;
    }
  }
};
</script>