<template>
  <div>
    <div class="text-center">
      <v-dialog v-model="dialogMenuBgColor" width="400">
        <v-card>
          <v-card-title class="headline grey" primary-title>Change Menu Color</v-card-title>
          <ColorPicker></ColorPicker>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="dialogMenuBgColor = false">I accept</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>
<script>
const ColorPicker = () => import("./ColorPicker");
export default {
  data() {
    return {
      dialogMenuBgColor: false
    };
  },
  components: {
    ColorPicker
  },
  props: {
    dialogIncomingBgColorOpen: Boolean
  },
  watch: {
    dialogMenuBgColor(val) {
      this.$emit("dialogBgApperanceClose", val);
    },
    dialogIncomingBgColorOpen(val) {
      this.dialogMenuBgColor = val;
    }
  }
};
</script>