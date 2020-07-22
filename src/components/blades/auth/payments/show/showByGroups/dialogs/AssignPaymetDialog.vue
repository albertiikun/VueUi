<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px" scrollable>
        <v-card>
          <v-form v-model="valid" ref="submitFormAssignPayment" @submit.prevent="submitForm">
            <v-card-title>
              <span class="headline">Users</span>
            </v-card-title>

            <v-card-text style="max-height: 500px;">
              <v-row>
                <v-col cols="6">
                  <v-select
                    v-model="model.payment"
                    :rules="[rules.required]"
                    :items="payments"
                    item-text="name"
                    :hint="model.payment ? `Price: ${model.payment.price} € / ${model.payment.schedule}` : '' "
                    item-value="id"
                    label="Select Payment"
                    return-object
                    persistent-hint
                    single-line
                  ></v-select>
                </v-col>
                <v-col cols="6">
                  <v-menu
                    ref="menu1"
                    v-model="menu1"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        readonly
                        v-model="dateFormatted"
                        label="Start Date"
                        hint="MM/DD/YYYY format"
                        persistent-hint
                        prepend-icon="event"
                        @blur="date = parseDate(dateFormatted)"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title @input="menu1 = false" :min="minDate()"></v-date-picker>
                  </v-menu>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
              <v-btn color="red darken-1" type="submit" text>Submit</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  computed: {
    computedDateFormatted() {
      return this.formatDate(this.date);
    }
  },
  props: {
    open: Boolean,
    ids: Object
  },

  data() {
    return {
      date: new Date().toISOString().substr(0, 10),
      dateFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu1: false,
      valid: false,
      model: { payment: "" },
      payments: [],
      dialog: false,
      rules: {
        required: v => !!v || "This field is required"
      }
    };
  },
  methods: {
    minDate() {
      var date = new Date();
      date.setMonth(date.getMonth() - 1);
      var isodate = date.toISOString().substr(0, 10);
      return isodate;
    },
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${month}/${day}/${year}`;
    },
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    submitForm() {
      if (this.$refs.submitFormAssignPayment.validate()) {
        var app = this;
        this.axios
          .post("api/payments/:assign-payment", {
            user_id: app.ids.userId,
            group_id: app.ids.groupId,
            payment_id: app.model.payment.id,
            start_date: app.date
          })
          .then(response => {
            app.dialog = false;
            app.$emit("snackBarFun", { color: "", text: response.data });
          })
          .catch(error => {
            console.log(error.response);
          });
      }
    },
    getPayments() {
      var app = this;
      this.axios
        .get("api/payments/:id-group-id", {
          params: {
            user_id: app.ids.userId,
            group_id: app.ids.groupId
          }
        })
        .then(response => {
          app.payments = [];
          for (let i = 0; i < response.data.length; i++) {
            app.payments.push(response.data[i]);
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  },
  watch: {
    date() {
      this.dateFormatted = this.formatDate(this.date);
    },
    open() {
      this.dialog = true;
    },
    dialog(val) {
      if (val == true) this.getPayments();
      this.$emit("closeAssignPaymetDialog", null);
    }
  }
};
</script>