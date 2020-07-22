import Vue from 'vue';
import axios from 'axios'

axios.defaults.baseURL = "http://localhost:8004/"
let token = localStorage.getItem('default_auth_token');


axios.get('api/roles/:auth-role-permission', {
    headers: {
        Authorization: 'Bearer ' + token
    }
}).then(response => {
    var words = response.data.map(v => v.toLowerCase());
    Vue.prototype.$hasPermissions = words;
})

export default {};