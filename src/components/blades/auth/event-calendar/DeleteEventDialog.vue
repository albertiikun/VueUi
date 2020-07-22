<template>
  <div>
    <v-dialog v-model="dialog" width="400">
      <v-card>
        <v-card-title primary-title>Confirm Delete Event</v-card-title>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false">Cancel</v-btn>
          <v-btn color="primary" text @click="submitForm">I accept</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
      dialog: false
    };
  },
  methods: {
    submitForm() {
      var app = this;
      this.axios
        .delete("api/events/:delete", {
          data: {
            id: app.id
          }
        })
        .then(response => {
          app.dialog = false;
          app.$emit("refreshCalendar", null);
          app.$emit("snackbarFun", {
            text: response.data
          });
        })
        .catch(error => {
          app.$emit("snackbarFun", {
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
      this.$emit("closeDeleteDialog", null);
    }
  }
};
</script>