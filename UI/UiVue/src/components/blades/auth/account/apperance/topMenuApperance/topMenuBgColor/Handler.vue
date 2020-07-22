<template>
  <div>
    <v-btn color="primary" fab small dark class="mr-2" @click="clickEdit">
      <v-icon>mdi-arrange-bring-forward</v-icon>
    </v-btn>
    <DialogMenuBgColor
      :dialogIncomingBgColorOpen="this.dialogBgApperance"
      @dialogBgApperanceClose="dialogBgApperanceClose"
    ></DialogMenuBgColor>
  </div>
</template>
<script>
const DialogMenuBgColor = () => import("./DialogMenuBgColor");
export default {
  components: {
    DialogMenuBgColor
  },
  data() {
    return {
      dialogBgApperance: false
    };
  },
  methods: {
    clickEdit() {
      this.dialogBgApperance = true;
    },
    dialogBgApperanceClose(val) {
      this.dialogBgApperance = val;
    }
  }
};
</script>