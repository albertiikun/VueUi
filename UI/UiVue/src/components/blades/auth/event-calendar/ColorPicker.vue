<template>
  <div>
    <v-dialog v-model="dialog" width="300">
      <v-card>
        <v-divider></v-divider>
        <v-color-picker v-model="color" show-swatches></v-color-picker>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="dialog = false">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    open: Boolean,
    colorValue: {
      type: String,
      default: "#FF00FF"
    }
  },
  data: () => ({
    types: ["hex", "hexa", "rgba", "hsla", "hsva"],
    type: "hex",
    hex: "#FF00FF",
    hexa: "#FF00FFFF",
    rgba: { r: 255, g: 0, b: 255, a: 1 },
    hsla: { h: 300, s: 1, l: 0.5, a: 1 },
    hsva: { h: 300, s: 1, v: 1, a: 1 },
    dialog: false
  }),
  watch: {
    showColor(val) {
      this.$emit("color", val);
    },
    dialog() {
      this.$emit("closeColorPickerDialog", null);
    },
    open() {
      this.dialog = true;
    },
    colorValue(value) {
      this.hex = value;
    }
  },

  computed: {
    color: {
      get() {
        return this[this.type];
      },
      set(v) {
        this[this.type] = v;
      }
    },
    showColor() {
      if (typeof this.color === "string") return this.color;

      return JSON.stringify(
        Object.keys(this.color).reduce((color, key) => {
          color[key] = Number(this.color[key].toFixed(2));
          return color;
        }, {}),
        null,
        2
      );
    }
  }
};
</script>