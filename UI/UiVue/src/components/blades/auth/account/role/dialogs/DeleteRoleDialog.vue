<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
          <v-form v-model="valid" ref="createRoleForm" @submit.prevent="submit">
            <v-card-title>Delete role: {{name}}</v-card-title>
            <v-divider></v-divider>
            <v-card-text class="mb-5"></v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="float-right" color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn
                class="float-right"
                color="red darken-1"
                type="submit"
                :loading="isLoadingSubmit"
              >Delete</v-btn>
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
    id: String,
    name: String
  },
  data() {
    return {
      isLoadingSubmit: false,
      dialog: false,
      valid: false
    };
  },
  methods: {
    submit() {
      this.isLoadingSubmit = true;
      var app = this;
      this.axios
        .delete("api/roles/:delete", {
          data: {
            role_id: app.id
          }
        })
        .then(response => {
          app.isLoadingSubmit = false;
          app.dialog = false;
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
            text: error.response.data
          });
        });
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog() {
      this.$emit("closeDeleteRoleDialog", null);
    }
  }
};
</script>