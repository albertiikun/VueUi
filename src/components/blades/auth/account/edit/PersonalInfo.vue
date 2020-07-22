<template>
  <div>
    <v-form v-model="valid" @submit.prevent="submitForm" ref="submitFormRef">
      <v-container>
        <v-row>
          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="userData.firstName"
              :rules="[rules.required, rules.max30]"
              :counter="30"
              label="First name"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="userData.lastName"
              :rules="[rules.required, rules.max30]"
              :counter="30"
              label="Last name"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="userData.phoneNumber"
              :rules="[rules.required]"
              v-mask="mask.phoneNumberMask"
              :counter="18"
              label="Phone Number"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="userData.birthDate"
              :rules="[rules.required]"
              v-mask="mask.bDayMask"
              :counter="10"
              label="BirthDate"
              required
            ></v-text-field>
          </v-col>

          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-select
              v-if="complete"
              v-model="userData.city"
              :hint="userData.city ? `zip code: ${userData.city.zip}` : ''"
              :rules="[rules.required]"
              :items="cities"
              item-text="name"
              item-value="id"
              label="Select city"
              persistent-hint
              return-object
              single-line
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-sheet
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader class="mx-auto" type="chip"></v-skeleton-loader>
            </v-sheet>
            <v-text-field
              v-if="complete"
              v-model="userData.country"
              :rules="[rules.required]"
              :counter="10"
              label="Country"
              required
              disabled
            ></v-text-field>
            <v-sheet
              class="float-right ml-5 mt-5"
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
            >
              <v-skeleton-loader class="mx-auto" type="button"></v-skeleton-loader>
            </v-sheet>
            <v-btn
              class="float-right ml-5 mt-5"
              color="primary"
              v-if="complete"
              type="submit"
              :loading="loadingSubmitButton"
            >Submit</v-btn>
            <v-sheet
              class="float-right ml-5 mt-5"
              v-if="!complete"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
            >
              <v-skeleton-loader class="mx-auto" type="button"></v-skeleton-loader>
            </v-sheet>
            <v-btn class="float-right mt-5" v-if="complete" text @click="resetForm">Reset Defaults</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <SnackbarComponent
      :snackbarActivate="this.snackbarActivate"
      :sendSnackBarText="this.snackBarText"
    ></SnackbarComponent>
  </div>
</template>
<script>
import SnackbarComponent from "./SnackBar";

export default {
  components: {
    SnackbarComponent
  },
  inject: ["theme"],
  mounted() {
    this.getUserId();
    this.getUser();
  },
  data() {
    return {
      id: null,
      loadingSubmitButton: false,
      cities: [],
      snackbarActivate: false,
      snackBarText: "",
      userData: {
        firstName: "",
        lastName: "",
        phoneNumber: "",
        birthDate: "",
        address: "",
        city: { id: "" },
        country: ""
      },
      complete: false,
      mask: {
        phoneNumberMask: "+383 (0##) ###-###",
        bDayMask: "##/##/####",
        ipMask: "###.###.###.###"
      },
      valid: false,
      email: "",
      rules: {
        required: v => !!v || "This field is required",
        max30: v => (v && v.length < 30) || "Must be less than 30 characters"
      }
    };
  },
  methods: {
    getUser() {
      var app = this;
      this.axios
        .get("api/users/:id", {
          params: {
            id: app.id
          }
        })
        .then(function(response) {
          app.userData.firstName = response.data.name;
          app.userData.lastName = response.data.lastName;
          app.userData.phoneNumber = response.data.phoneNumber;
          app.userData.birthDate = response.data.birthDate;
          app.userData.city.id = response.data.city_id;
          app.GetCountry(response.data.city_id);
          app.GetCities();
        });
    },
    GetCities: function() {
      var app = this;
      this.axios
        .get("/api/city/")
        .then(function(response) {
          for (let i = 0; i < response.data.length; i++) {
            app.cities.push({
              name: response.data[i].name,
              id: response.data[i].id,
              zip: response.data[i].zipCode,
              countryId: response.data[i].country_id
            });
          }
        })
        .then(function() {
          app.complete = true;
        });
    },
    GetCountry: function(Countryid) {
      var app = this;
      this.axios
        .get("/api/country/:cityId", {
          params: {
            id: Countryid
          }
        })
        .then(function(response) {
          app.userData.country = response.data[0].name;
        })
        .then(function() {});
    },

    resetForm: function() {
      this.complete = false;
      this.cities = [];
      this.getUser();
    },

    submitForm: function() {
      if (this.$refs.submitFormRef.validate()) {
        this.loadingSubmitButton = true;
        var app = this;
        this.axios
          .put("/api/users/:update", {
            id: app.id,
            name: this.userData.firstName,
            lastName: this.userData.lastName,
            phoneNumber: this.userData.phoneNumber,
            birthDate: this.userData.birthDate,
            city_id: this.userData.city.id
          })
          .then(res => {
            this.snackbarActivate = !this.snackbarActivate;
            this.snackBarText = res.data;
            this.loadingSubmitButton = false;
          })
          .catch(error => {
            //handle error
            if (error.response.status === 403) {
              this.snackbarActivate = !this.snackbarActivate;
              this.snackBarText = error.response.data;
            }
            this.loadingSubmitButton = false;
          });
      }
    },
    getUserId() {
      var token = localStorage.getItem("default_auth_token");
      var parsedToken = JSON.parse(atob(token.split(".")[1]));
      this.id = parsedToken.sub;
    }
  }
};
</script> 