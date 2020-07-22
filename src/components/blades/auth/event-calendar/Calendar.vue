<template>
  <div>
    <v-row class="fill-height">
      <v-col>
        <v-sheet height="64">
          <v-toolbar>
            <v-btn outlined class="mr-4" color="white darken-2" @click="setToday">Today</v-btn>
            <v-btn fab text small color="white darken-2" @click="prev">
              <v-icon small>mdi-chevron-left</v-icon>
            </v-btn>
            <v-btn fab text small color="white darken-2" @click="next">
              <v-icon small>mdi-chevron-right</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-menu bottom right>
              <template v-slot:activator="{ on }">
                <v-btn outlined color="white darken-2" v-on="on">
                  <span>{{ typeToLabel[type] }}</span>
                  <v-icon right>mdi-menu-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item @click="type = 'day'">
                  <v-list-item-title>Day</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'week'">
                  <v-list-item-title>Week</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'month'">
                  <v-list-item-title>Month</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
            <v-btn
              fab
              small
              class="ml-5"
              @click="addEventDialog"
              v-if="$hasPermissions.includes('event create')"
            >
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </v-toolbar>
        </v-sheet>
        <v-sheet height="600">
          <v-progress-linear color="blue" v-if="isLoading" height="4" indeterminate></v-progress-linear>
          <v-calendar
            ref="calendar"
            v-model="focus"
            color="primary"
            :events="events"
            :event-color="getEventColor"
            :type="type"
            @click:event="showEvent"
            @click:more="viewDay"
            @click:date="viewDay"
            @change="updateRange"
          ></v-calendar>
          <v-menu
            v-model="selectedOpen"
            :close-on-content-click="false"
            :activator="selectedElement"
            offset-x
          >
            <v-card color="grey lighten-4" min-width="350px" flat>
              <v-toolbar :color="selectedEvent.color" dark>
                <v-btn
                  icon
                  @click="editEvent(selectedEvent)"
                  v-if="$hasPermissions.includes('event edit')"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn
                  icon
                  @click="deleteEventDialog(selectedEvent.id)"
                  v-if="$hasPermissions.includes('event delete')"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </v-toolbar>
              <v-card-text style="color:black">
                <span v-html="selectedEvent.description"></span>
              </v-card-text>
              <v-card-actions>
                <v-btn text color="secondary" @click="selectedOpen = false">Cancel</v-btn>
              </v-card-actions>
            </v-card>
          </v-menu>
        </v-sheet>
      </v-col>
    </v-row>
    <CreateEventDialog
      :open="this.createDialog.open"
      @closeCreateEventDialog="closeCreateEventDialog"
      @refreshCalendar="refreshCalendar"
      @snackbarFun="snackbarFun"
    ></CreateEventDialog>
    <EditEventDialog
      :open="this.editDialog.open"
      :selectedEvent="this.editDialog.selectedEvent"
      @closeEditEventDialog="closeEditEventDialog"
      @refreshCalendar="refreshCalendar"
      @snackbarFun="snackbarFun"
    ></EditEventDialog>
    <DeleteEventDialog
      :open="this.deleteDialog.open"
      :id="this.deleteDialog.id"
      @closeDeleteDialog="closeDeleteDialog"
      @refreshCalendar="refreshCalendar"
      @snackbarFun="snackbarFun"
    ></DeleteEventDialog>
    <SnackBar
      :snackbarActivate="this.snackbarActivate"
      :snackBarColor="this.snackBarColor"
      :sendSnackBarText="this.snackBarText"
    ></SnackBar>
  </div>
</template>

<script>
const CreateEventDialog = () => import("./CreateEventDialog");
const EditEventDialog = () => import("./EditEventDialog");
const DeleteEventDialog = () => import("./DeleteEventDialog");
const SnackBar = () => import("./SnackBar");
export default {
  components: {
    CreateEventDialog,
    EditEventDialog,
    DeleteEventDialog,
    SnackBar
  },
  data: () => ({
    snackbarActivate: false,
    snackBarColor: "",
    snackBarText: "",
    focus: "",
    type: "month",
    typeToLabel: {
      month: "Month",
      week: "Week",
      day: "Day"
    },
    start: null,
    end: null,
    selectedEvent: {},
    selectedElement: null,
    selectedOpen: false,
    events: [],
    createDialog: {
      open: false
    },
    editDialog: {
      open: false,
      selectedEvent: {}
    },
    deleteDialog: {
      open: false,
      id: ""
    },
    isLoading: false
  }),
  computed: {
    title() {
      const { start, end } = this;
      if (!start || !end) {
        return "";
      }

      const startMonth = this.monthFormatter(start);
      const endMonth = this.monthFormatter(end);
      const suffixMonth = startMonth === endMonth ? "" : endMonth;

      const startYear = start.year;
      const endYear = end.year;
      const suffixYear = startYear === endYear ? "" : endYear;

      const startDay = start.day + this.nth(start.day);
      const endDay = end.day + this.nth(end.day);

      switch (this.type) {
        case "month":
          return `${startMonth} ${startYear}`;
        case "week":
        case "4day":
          return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`;
        case "day":
          return `${startMonth} ${startDay} ${startYear}`;
      }
      return "";
    },
    monthFormatter() {
      return this.$refs.calendar.getFormatter({
        timeZone: "UTC",
        month: "long"
      });
    }
  },
  mounted() {
    this.$refs.calendar.checkChange();
  },
  methods: {
    snackbarFun(data) {
      this.snackbarActivate = !this.snackbarActivate;
      this.snackBarText = data.text;
      this.snackBarColor = data.color;
    },
    deleteEventDialog(id) {
      this.deleteDialog.open = true;
      this.deleteDialog.id = id;
    },
    closeDeleteDialog() {
      this.deleteDialog.open = false;
    },
    editEvent(selectedEvent) {
      this.editDialog.open = true;
      this.editDialog.selectedEvent = selectedEvent;
    },
    closeEditEventDialog() {
      this.editDialog.open = false;
    },
    refreshCalendar() {
      this.getEvents();
    },
    addEventDialog() {
      this.createDialog.open = true;
    },
    closeCreateEventDialog() {
      this.createDialog.open = false;
    },
    getEvents() {
      this.isLoading = true;
      this.axios.get("api/events").then(response => {
        const events = [];

        for (let i = 0; i < response.data.length; i++) {
          events.push({
            name: response.data[i].name,
            start: response.data[i].from,
            end: response.data[i].to,
            color: response.data[i].color,
            description: response.data[i].description,
            id: response.data[i].id
          });
        }
        this.events = events;
        this.isLoading = false;
      });
    },
    viewDay({ date }) {
      this.focus = date;
      this.type = "day";
    },
    getEventColor(event) {
      return event.color;
    },
    setToday() {
      this.focus = this.today;
    },
    prev() {
      this.$refs.calendar.prev();
    },
    next() {
      this.$refs.calendar.next();
    },
    showEvent({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event;
        this.selectedElement = nativeEvent.target;
        setTimeout(() => (this.selectedOpen = true), 10);
      };

      if (this.selectedOpen) {
        this.selectedOpen = false;
        setTimeout(open, 10);
      } else {
        open();
      }

      nativeEvent.stopPropagation();
    },
    updateRange() {
      this.getEvents();
    },
    nth(d) {
      return d > 3 && d < 21
        ? "th"
        : ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th"][d % 10];
    },
    rnd(a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a;
    },
    formatDate(a, withTime) {
      return withTime
        ? `${a.getFullYear()}-${a.getMonth() +
            1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
        : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
    }
  }
};
</script>