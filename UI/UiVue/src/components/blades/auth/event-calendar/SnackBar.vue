<template>
  <div>
    <v-snackbar v-model="snackBar" :color="color">
      {{ snackBarText }}
      <v-btn color="white" text @click="snackBar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  props: {
    snackBarColor: String,
    sendSnackBarText: String,
    snackbarActivate: Boolean
  },
  data() {
    return {
      snackBar: false,
      snackBarText: "",
      color: ""
    };
  },
  watch: {
    snackbarActivate: function() {
      this.snackBar = true;
    },
    sendSnackBarText: function(val) {
      this.snackBarText = val;
    },
    snackBarColor: function(val) {
      this.color = val;
    }
  }
};
</script>