<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px" scrollable>
        <v-card>
          <v-form v-model="valid" ref="submitFormPayment" @submit.prevent="submitForm">
            <v-card-title>
              <span class="headline">Create Payment</span>
            </v-card-title>
            <v-card-text style="max-height: 500px;"></v-card-text>
            <v-divider></v-divider>
            <v-container>
              <v-row>
                <v-col cols="6">
                  <v-text-field
                    v-model="model.name"
                    class="mt-5"
                    :counter="100"
                    :rules="[rules.required, rules.max100, this.isTaken ? rules.nameIsTaken : true]"
                    label="Payment Name"
                    required
                    @click="isTaken = false"
                  ></v-text-field>
                </v-col>
                <v-col cols="6">
                  <v-select
                    v-model="model.schedule"
                    class="mt-5"
                    :rules="[rules.required]"
                    :items="paymentSchedule"
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
                    :items="groups"
                    item-text="name"
                    item-value="id"
                    label="Select Group"
                    return-object
                    single-line
                    clearable
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
              <v-btn color="red darken-1" type="submit" text :loading="isSubmitLoading">Submit</v-btn>
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
    groups: Array,
    paymentSchedule: Array
  },
  data() {
    return {
      isSubmitLoading: false,
      model: {
        name: "",
        group: { id: "" },
        price: 0,
        schedule: { id: "" }
      },
      isTaken: false,
      valid: false,
      dialog: false,
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
      if (this.$refs.submitFormPayment.validate()) {
        this.isSubmitLoading = true;
        var app = this;
        this.axios
          .post("api/payments/:create", {
            group_id: app.model.group ? app.model.group.id : null,
            name: app.model.name,
            price: app.model.price,
            paymentSchedule_id: app.model.schedule.id
          })
          .then(response => {
            app.$emit("snackBarFun", { color: "", text: response.data });
            app.dialog = false;
            app.model.name = "";
            app.model.price = 0;
            app.isSubmitLoading = false;
          })
          .catch(error => {
            if (error.response.data["name"][0] != null) {
              app.isTaken = true;
            } else {
              app.$emit("snackBarFun", {
                color: "red darken-3",
                text: error.response.data
              });
            }
            app.isSubmitLoading = false;
          });
      }
    }
  },
  watch: {
    open() {
      this.dialog = true;
    },
    dialog() {
      this.$emit("closeDialog", null);
    }
  }
};
</script>