<template>
  <div>
    <v-snackbar v-model="snackBar">
      {{ snackBarText }}
      <v-btn color="pink" text @click="snackBar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  props: {
    sendSnackBarText: String,
    snackbarActivate: Boolean
  },
  data() {
    return {
      snackBar: false,
      snackBarText: ""
    };
  },
  watch: {
    snackbarActivate: function() {
      this.snackBar = true;
    },
    sendSnackBarText: function(val) {
      this.snackBarText = val;
    }
  }
};
</script>