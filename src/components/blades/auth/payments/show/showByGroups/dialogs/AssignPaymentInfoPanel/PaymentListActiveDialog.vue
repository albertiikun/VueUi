<template>
  <div>
    <v-dialog v-model="dialog" max-width="400px" scrollable>
      <v-card>
        <v-card-title>
          <span class="headline">Payment status</span>
        </v-card-title>
        <v-card-text style="max-height: 500px;">
          <p v-if="status">Status: Paid</p>
          <p v-else>Status: Not Paid</p>
          <v-row justify="center">
            <v-col cols="4">
              <v-chip dark class="mr-4" :color="status ? 'green' : ''" link @click="status = 1">
                <v-icon small link>mdi-check</v-icon>
              </v-chip>
              <v-chip dark link :color="!status ? 'red' : ''" @click="status = 0">
                <v-icon small link>mdi-close</v-icon>
              </v-chip>
            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="red darken-1" text @click="submitForm">Submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    open: Boolean,
    id: String,
    active: [Boolean, Number]
  },
  data() {
    return {
      dialog: false,
      status: false
    };
  },
  methods: {
    submitForm() {
      var app = this;

      this.axios
        .post("api/payments/:make-paid-unpaid-id", {
          id: app.id,
          status: app.status
        })
        .then(response => {
          console.log(response);
          app.dialog = false;
          app.$emit("refreshPaymentList", null);
        });
    }
  },
  watch: {
    open() {
      this.status = this.active;
      this.dialog = true;
    },
    dialog() {
      this.$emit("closeDialog", null);
    }
  }
};
</script>