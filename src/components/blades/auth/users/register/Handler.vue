<template>
  <div>
    <v-stepper v-model="e1" dark>
      <v-stepper-header>
        <v-stepper-step editable :complete="e1 > 1" step="1">step 1</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step editable :step="2">step 2</v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content step="1">
          <v-form ref="step1" v-model="valid" lazy-validation>
            <v-card class="mb-12" style="min-height: 24rem;">
              <v-row class="ml-4 mr-4">
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    label="First name"
                    v-model="registerModel.firstName"
                    :rules="[rules.required, rules.max30]"
                    clearable
                    counter="30"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    label="Last name"
                    v-model="registerModel.lastName"
                    :rules="[rules.required, rules.max30]"
                    clearable
                    counter="30"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-select
                    v-model="registerModel.gender"
                    :items="genders"
                    :rules="[rules.required]"
                    label="Gender"
                  ></v-select>
                </v-col>
                <v-col cols="12" md="6">
                  <v-select
                    v-model="registerModel.city"
                    :hint="registerModel.city ? `zip code: ${registerModel.city.zip}` : ''"
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
                  <v-text-field
                    dense
                    label="Birth Day"
                    v-mask="mask.bDayMask"
                    v-model="registerModel.birthDay"
                    :rules="[rules.required]"
                    placeholder="DD/MM/YYYY"
                    clearable
                    counter="10"
                    hint="DD/MM/YYYY"
                  ></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    label="Phone Number"
                    v-model="registerModel.phoneNumber"
                    :rules="[rules.required, rules.phoneNumber]"
                    v-mask="mask.phoneNumberMask"
                    placeholder="+383 (xxx) xxx-xxx"
                    clearable
                    counter="18"
                    hint="+383 (xxx) xxx-xxx"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-file-input
                    v-model="registerModel.files"
                    :rules="[rules.imageRequired]"
                    counter
                    label="Add a photo"
                    multiple
                    prepend-icon="add_a_photo"
                    :show-size="1000"
                  >
                    <template v-slot:selection="{ index, text }">
                      <v-chip v-if="index < 2" dark label small>{{ text }}</v-chip>

                      <span
                        v-else-if="index === 2"
                        class="overline grey--text text--darken-3 mx-2"
                      >+{{ files.length - 2 }} File(s)</span>
                    </template>
                  </v-file-input>
                </v-col>
                <v-col cols="12" md="6">
                  <v-select
                    :rules="[rules.required]"
                    v-model="registerModel.role"
                    :items="roles"
                    label="Role"
                  ></v-select>
                </v-col>
              </v-row>
            </v-card>
          </v-form>
          <v-btn class="float-right ml-5" color="primary" @click="e1 = 2">Continue</v-btn>

          <v-btn class="float-right" text>Cancel</v-btn>
        </v-stepper-content>

        <v-stepper-content :step="2">
          <v-form ref="step2" v-model="valid" lazy-validation>
            <v-card class="mb-12" style="min-height: 24rem;">
              <v-row class="ml-4 mr-4">
                <v-col cols="12">
                  <v-text-field
                    dense
                    label="Device Restriction"
                    v-mask="mask.ipMask"
                    v-model="registerModel.devRestriction"
                    :rules="[rules.max30]"
                    clearable
                    counter="30"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    label="Email"
                    v-model="registerModel.email"
                    :rules="[rules.required, rules.email, rules.max30,this.showErrors.emailIsTaken ? rules.checkEmail : true]"
                    clearable
                    counter="30"
                    @change="checkEmailExist"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    label="Username"
                    v-model="registerModel.userName"
                    :rules="[rules.required, rules.max30, this.showErrors.usernameIsTaken ? rules.checkUsername : true]"
                    clearable
                    counter="30"
                    @change="checkUsernameExist"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    v-model="registerModel.password"
                    :type="passwordEye.show1 ? 'text' : 'password'"
                    @click:append="passwordEye.show1 = !passwordEye.show1"
                    v-on:keyup="password_confirm_value"
                    :append-icon="passwordEye.show1 ? 'visibility' : 'visibility_off'"
                    label="Password"
                    :rules="[rules.required, rules.min,rules.passStrong, rules.max100]"
                    loading
                    counter="100"
                  >
                    <template v-slot:progress>
                      <v-progress-linear
                        v-if="custom"
                        :value="progress"
                        :color="color"
                        absolute
                        height="4"
                      ></v-progress-linear>
                    </template>
                  </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    dense
                    v-model="registerModel.password_confirmation"
                    :type="passwordEye.show2 ? 'text' : 'password'"
                    @click:append="passwordEye.show2 = !passwordEye.show2"
                    :append-icon="passwordEye.show2 ? 'visibility' : 'visibility_off'"
                    label="Password"
                    :rules="[rules.required, rules.min, rules.passMatch, rules.max100]"
                    loading
                    counter="100"
                    required
                  >
                    <template v-slot:progress>
                      <v-progress-linear
                        v-if="custom"
                        :value="progress1"
                        :color="color1"
                        absolute
                        height="4"
                      ></v-progress-linear>
                    </template>
                  </v-text-field>
                </v-col>
              </v-row>
            </v-card>
          </v-form>

          <v-btn class="float-right ml-5" color="primary" @click="validate">Finish</v-btn>
          <v-btn class="float-right" text>Cancel</v-btn>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
    <SnackBar :snackbarActivate="this.snackbarActivate" :sendSnackBarText="this.snackBarText"></SnackBar>
  </div>
</template>
<script>
const SnackBar = () => import("./Snackbar");
export default {
  components: {
    SnackBar
  },
  mounted() {
    this.GetRoles();
    this.GetGenders();
    this.GetCities();
  },
  data() {
    return {
      snackbarActivate: false,
      snackBarText: "",
      genders: [],
      roles: [],
      cities: [],
      mask: {
        phoneNumberMask: "+383 (0##) ###-###",
        bDayMask: "##/##/####",
        ipMask: "###.###.###.###"
      },
      valid: true,
      custom: true,
      passwordEye: {
        show1: false,
        show2: false
      },
      registerModel: {
        files: [],
        firstName: "",
        lastName: "",
        gender: "",
        address: "",
        city: "",
        zip: "",
        birthDay: "",
        email: "",
        userName: "",
        password_confirmation: "",
        password: "",
        phoneNumber: "",
        role: "",
        devRestriction: ""
      },
      showErrors: {
        emailIsTaken: false,
        usernameIsTaken: false
      },
      e1: 1,
      rules: {
        checkUsername: "Username is Taken",
        checkEmail: "Email is Taken",
        imageRequired: v => !!v.length || "This field is required",
        selectRequired: v => !!v.length || "This field is required",
        required: v => !!v || "This field is required",
        min: v => v.length >= 8 || "Min 8 characters",
        max30: v => v.length < 30 || "Must be less than 30 characters",
        max100: v => v.length <= 100 || "Must be less than 100 characters",
        email: v =>
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(([[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            v
          ) || "E-mail must be valid",
        passMatch: v =>
          v == this.registerModel.password ||
          "The password you entered don't match",
        passStrong: v =>
          /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(
            v
          ) || "Password is weak, please use uppercase, number and symbol.",
        phoneNumber: v =>
          (v && v.length >= 18) || "Phone number is not valid yet"
      }
    };
  },
  computed: {
    progress() {
      var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;

      if (regex.exec(this.registerModel.password)) {
        return 100;
      } else {
        return Math.min(50, this.registerModel.password.length * 7);
      }
    },
    color() {
      return ["error", "warning", "success"][Math.floor(this.progress / 50)];
    },
    progress1() {
      var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;

      if (regex.exec(this.registerModel.password_confirmation)) {
        return 100;
      } else {
        return Math.min(
          50,
          this.registerModel.password_confirmation.length * 7
        );
      }
    },
    color1() {
      return ["error", "warning", "success"][Math.floor(this.progress1 / 50)];
    }
  },
  methods: {
    register() {
      var app = this;
      this.axios
        .post("/api/users/:register", {
          gender: app.registerModel.gender,
          name: app.registerModel.firstName,
          lastName: app.registerModel.lastName,
          city_id: app.registerModel.city.id,
          zip: app.registerModel.city.zip,
          birthDate: app.registerModel.birthDay,
          email: app.registerModel.email,
          userName: app.registerModel.userName,
          password: app.registerModel.password,
          password_confirmation: app.registerModel.password_confirmation,
          phoneNumber: app.registerModel.phoneNumber,
          role_id: app.registerModel.role
        })
        .then(function() {
          app.$router.push({ name: "Users" });
        })
        .catch(error => {
          this.snackbarActivate = !this.snackbarActivate;
          this.snackBarText = error.response.data;
        });
    },
    password_confirm_value: function() {
      this.registerModel.password_confirmation = "";
    },
    validate() {
      if (this.$refs.step2.validate() && this.$refs.step1.validate()) {
        this.register();
      } else if (!this.$refs.step1.validate()) {
        this.e1 = 1;
      } else if (!this.$refs.step2.validate()) {
        this.e1 = 2;
      }
    },
    GetRoles: function() {
      var app = this;
      this.axios
        .get("/api/roles/")
        .then(function(response) {
          for (let i = 0; i < response.data.length; i++) {
            app.roles.push({
              value: response.data[i].id,
              text: response.data[i].name
            });
          }
        })
        .catch(err => {
          this.snackbarActivate = !this.snackbarActivate;
          this.snackBarText = err.response.data;
        });
    },
    GetGenders: function() {
      var app = this;
      this.axios
        .get("/api/gender/")
        .then(function(response) {
          for (let i = 0; i < response.data.length; i++) {
            app.genders.push({
              value: response.data[i].id,
              text: response.data[i].name
            });
          }
        })
        .then(function() {});
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
              zip: response.data[i].zipCode
            });
          }
        })
        .then(function() {});
    },
    checkEmailExist: function() {
      this.showErrors.emailIsTaken = false;
      var app = this;
      this.axios
        .get("/api/users/:email", {
          params: {
            email: this.registerModel.email
          }
        })
        .then(function() {
          app.showErrors.emailIsTaken = false;
        })
        .catch(function() {
          app.showErrors.emailIsTaken = true;
        });
    },
    checkUsernameExist: function() {
      this.showErrors.usernameIsTaken = false;
      var app = this;
      this.axios
        .get("/api/users/:username", {
          params: {
            userName: this.registerModel.userName
          }
        })
        .then(function() {
          app.showErrors.usernameIsTaken = false;
        })
        .catch(function() {
          app.showErrors.usernameIsTaken = true;
        });
    }
  }
};
</script>