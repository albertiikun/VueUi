<template>
  <div>
    <v-dialog v-model="dialog" max-width="600px" scrollable>
      <v-card>
        <v-form v-model="valid" ref="submitFormPaymentUpdate" @submit.prevent="submitForm">
          <v-card-title>
            <span class="headline">Edit Payment</span>
          </v-card-title>
          <v-card-text style="max-height: 500px;"></v-card-text>
          <v-divider></v-divider>
          <v-progress-linear color="blue" v-if="isLoading" height="4" indeterminate></v-progress-linear>

          <v-container>
            <v-row>
              <v-col cols="6">
                <v-text-field
                  v-model="model.name"
                  class="mt-5"
                  :counter="100"
                  :rules="[rules.required, rules.max100, this.isTakenName ? rules.nameIsTaken : true]"
                  label="Payment Name"
                  required
                  @click="isTakenName = false"
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-select
                  v-model="model.schedule"
                  class="mt-5"
                  :rules="[rules.required]"
                  v-bind:items="paymentSchedule"
                  item-text="name"
                  item-value="id"
                  label="Select Schedule"
                  return-object
                  single-line
                ></v-select>
              </v-col>
              <v-col cols="6">
                <v-select
                  v-model="model.group"
                  class="mt-5"
                  :rules="[rules.required]"
                  v-bind:items="groups"
                  item-text="name"
                  item-value="id"
                  label="Select Group"
                  return-object
                  single-line
                ></v-select>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  v-model.number="model.price"
                  type="number"
                  class="mt-5"
                  :counter="100"
                  :rules="[rules.unsigned]"
                  label="Price"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn
              color="red darken-1"
              type="submit"
              text
              :disabled="isLoading"
              :loading="isSubmitLoading"
            >Submit</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    open: Boolean,
    id: String,
    groups: Array,
    paymentSchedule: Array
  },
  data() {
    return {
      isSubmitLoading: false,
      isLoading: false,
      dialog: false,
      isTakenName: false,
      model: {
        name: "",
        group: "",
        price: 0,
        schedule: ""
      },
      valid: true,
      rules: {
        nameIsTaken: "Name is already been taken",
        required: v => !!v || "This field is required",
        requiredNumber: v => v != null || "This field is required",
        max10: v => (v && v.length <= 10) || "Must be less than 10 characters",
        max100: v =>
          (v && v.length <= 100) || "Must be less than 100 characters",
        unsigned: v => v >= 0 || "You cannot chose value lower than 0",
        maxNumber: v => v <= 100 || "You should chose number 100 or less"
      }
    };
  },
  methods: {
    submitForm() {
      this.isSubmitLoading = true;
      var groupId;
      var scheduleId;
      if (this.$refs.submitFormPaymentUpdate.validate()) {
        if (typeof this.model.group === "object") {
          groupId = this.model.group.id;
        } else {
          groupId = this.model.group;
        }

        if (typeof this.model.schedule === "object") {
          scheduleId = this.model.schedule.id;
        } else {
          scheduleId = this.model.schedule;
        }

        var app = this;
        this.axios
          .post("api/payments/:update", {
            id: app.id,
            name: app.model.name,
            group_id: groupId,
            price: app.model.price,
            paymentSchedule_id: scheduleId
          })
          .then(response => {
            app.dialog = false;
            app.$emit("refreshPayments", null);
            app.isSubmitLoading = false;

            app.$emit("snackBarFun", {
              color: "",
              text: response.data
            });
          })
          .catch(error => {
            if (error.response.data["name"][0] != null) {
              app.isTakenName = true;
            } else {
              app.$emit("snackBarFun", {
                color: "red darken-3",
                text: error.response.data
              });
            }

            app.isSubmitLoading = false;
          });
      }
    },

    getPaymentById() {
      this.isLoading = true;
      var app = this;
      this.axios
        .get("api/payments/:id", {
          params: {
            id: app.id
          }
        })
        .then(response => {
          app.model.name = response.data.name;
          app.model.price = response.data.price;
          app.model.group = response.data.group_id;
          app.model.schedule = response.data.paymentSchedule_id;
          app.isLoading = false;
        });
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog(val) {
      if (val == true) {
        this.model.name = "";
        this.model.price = "";
        this.getPaymentById();
      }
      this.$emit("closeEditDialog", null);
    }
  }
};
</script>