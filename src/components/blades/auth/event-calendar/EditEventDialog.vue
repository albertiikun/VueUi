<template>
  <div>
    <v-dialog v-model="dialog" max-width="600px" scrollable persistent>
      <v-card>
        <v-form v-model="valid" ref="submitFormEditEvent" @submit.prevent="submitForm">
          <v-card-title>
            <span class="headline">Edit Event</span>
          </v-card-title>
          <v-card-text style="max-height: 400px;">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="model.name"
                  class="mt-5"
                  :counter="100"
                  label="Event Name"
                  :rules="[rules.required]"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-datetime-picker
                  :isRequired="true"
                  persistent
                  class="mt-5"
                  label="From Date-Time"
                  v-model="model.from"
                ></v-datetime-picker>
              </v-col>
              <v-col cols="6">
                <v-datetime-picker
                  :isRequired="true"
                  persistent
                  class="mt-5"
                  label="To Date-Time"
                  v-model="model.to"
                ></v-datetime-picker>
              </v-col>
              <v-col cols="12">
                <v-textarea
                  v-model="model.description"
                  filled
                  row-height="8"
                  auto-grow
                  clearable
                  label="Description"
                  counter="200"
                ></v-textarea>
              </v-col>
              <v-col cols="12">
                <h3>
                  Click cyrcle to select color:
                  <v-btn
                    fab
                    class="ml-5"
                    :color="this.model.colorVal"
                    @click="openColorPickerDialog"
                  ></v-btn>
                </h3>
              </v-col>
            </v-row>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="red darken-1" text type="submit">Submit</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    <ColorPicker
      :colorValue="this.model.colorVal"
      :open="this.dialogColorPicker.open"
      @closeColorPickerDialog="closeColorPickerDialog"
      @color="color"
    ></ColorPicker>
  </div>
</template>
<script>
const ColorPicker = () => import("./ColorPicker");
export default {
  components: {
    ColorPicker
  },
  props: {
    open: Boolean,
    selectedEvent: Object
  },
  data() {
    return {
      dialogColorPicker: {
        open: false
      },
      dialog: false,
      valid: false,
      model: {
        from: "",
        to: "",
        name: "",
        description: "",
        colorVal: "#FF00FFFF"
      },
      rules: {
        required: v => !!v || "This field is required"
      }
    };
  },
  methods: {
    assignData() {
      this.model.name = this.selectedEvent.name;
      this.model.from = this.formatDate(
        new Date(this.selectedEvent.start),
        true
      );
      this.model.to = this.formatDate(new Date(this.selectedEvent.end), true);
      this.model.colorVal = this.selectedEvent.color;
      this.model.description = this.selectedEvent.description;
    },
    formatDate(a, withTime) {
      return withTime
        ? `${a.getFullYear()}-${a.getMonth() +
            1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
        : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
    },
    color(val) {
      this.model.colorVal = val;
    },
    submitForm() {
      if (this.$refs.submitFormEditEvent.validate()) {
        var app = this;
        this.axios
          .post("api/events/:edit", {
            id: app.selectedEvent.id,
            name: app.model.name,
            from: app.model.from,
            to: app.model.to,
            description: app.model.description,
            color: app.model.colorVal
          })
          .then(response => {
            app.dialog = false;
            app.$emit("refreshCalendar", null);
            app.$emit("snackbarFun", {
              text: response.data
            });
          })
          .catch(error => {
            app.$emit("snackbarFun", {
              color: "red darken-3",
              text: error.response.data
            });
          });
      }
    },
    closeColorPickerDialog() {
      this.dialogColorPicker.open = false;
    },
    openColorPickerDialog() {
      this.dialogColorPicker.open = true;
    }
  },
  watch: {
    open() {
      this.dialog = true;
      this.assignData();
    },
    dialog() {
      this.$emit("closeEditEventDialog", null);
    }
  }
};
</script>