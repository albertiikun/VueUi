import Vue from 'vue'
import App from './GlobalApp.vue'
import vuetify from './plugins/vuetify';
import router from './router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import * as VeeValidate from 'vee-validate';
import VueTheMask from 'vue-the-mask'
import DatetimePicker from 'vuetify-datetime-picker'
import rolePermission from './rolePermission';
Vue.use(DatetimePicker)

Vue.use(VueTheMask)
Vue.use(router)

Vue.use(VeeValidate, {
  inject: false,
  fieldsBagName: '$veeFields',
  errorBagName: '$veeErrors'
})

const ignoredMessage = "The .native modifier for v-on is only valid on components but it was used on <div>.";

Vue.config.warnHandler = (message, vm, componentTrace) => {
  if (message !== ignoredMessage) {
    console.error(message + componentTrace);
  }
};

Vue.use(VueAxios, axios)
Vue.config.productionTip = false

Vue.router = router;

Vue.axios.defaults.baseURL = "http://localhost:8004/"

Vue.use(VueAuth, {
  auth: require('./authDriver'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  loginData: { url: 'api/oauth/token', method: 'POST', redirect: '/home', fetchUser: false },
  logoutData: { url: 'api/oauth/logout', method: 'POST', redirect: '/login', makeRequest: true },
  fetchData: { url: 'api/oauth/user', method: 'GET', enabled: true },
  refreshData: { url: 'api/oauth/token/refresh', method: 'POST', enabled: false, interval: 30 },
  tokenStore: ['localStorage'],
  token: [{ request: 'access_token', response: 'access_token', authType: 'authDriver', foundIn: 'response' }],
  registerData: { url: 'api/users/register', method: 'POST' }
});

new Vue({
  vuetify,
  router,
  rolePermission,
  render: h => h(App)
}).$mount('#app')
