<template>
  <div>
    <v-progress-linear color="blue" v-if="isLoading" height="4" indeterminate></v-progress-linear>
    <v-simple-table height="640px" v-if="id" fixed-header>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">From date</th>
            <th class="text-left">To date</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="payment in paymentList"
            :key="payment.id"
            :style="!payment.active ? 'background-color:#B71C1C' : ''"
          >
            <td>{{ payment.from }}</td>
            <td>{{ payment.to }}</td>
            <td>
              <v-chip dark>
                <v-icon
                  v-if="payment.active"
                  small
                  link
                  @click="openActiveModal(payment.id, payment.active)"
                >mdi-check</v-icon>
                <v-icon
                  v-else
                  small
                  link
                  @click="openActiveModal(payment.id, payment.active)"
                >mdi-close</v-icon>
              </v-chip>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <PaymentListActiveDialog
      :id="this.dialogPaymentListActive.id"
      :open="this.dialogPaymentListActive.open"
      :active="this.dialogPaymentListActive.active"
      @closeDialog="closeDialog"
      @refreshPaymentList="refreshPaymentList"
    ></PaymentListActiveDialog>
  </div>
</template>
<script>
const PaymentListActiveDialog = () => import("./PaymentListActiveDialog");
export default {
  components: {
    PaymentListActiveDialog
  },
  props: {
    id: String
  },
  data() {
    return {
      dialogPaymentListActive: {
        open: false,
        id: "",
        active: false
      },
      paymentList: [],
      isLoading: false
    };
  },
  methods: {
    getPaymentList() {
      this.isLoading = true;
      var app = this;
      this.axios
        .get("api/payments/:user-payment-list", {
          params: {
            id: app.id
          }
        })
        .then(response => {
          app.isLoading = false;
          app.paymentList = [];
          app.paymentList = response.data;
        })
        .catch(error => {
          app.isLoading = false;
          console.log(error.response);
        });
    },
    openActiveModal(id, active) {
      this.dialogPaymentListActive.open = true;
      this.dialogPaymentListActive.id = id;
      this.dialogPaymentListActive.active = active;
    },
    closeDialog() {
      this.dialogPaymentListActive.open = false;
    },
    refreshPaymentList() {
      this.getPaymentList();
      this.$emit("refreshUserPayment", null);
    }
  },
  watch: {
    id() {
      this.paymentList = [];
      this.getPaymentList();
    }
  }
};
</script>