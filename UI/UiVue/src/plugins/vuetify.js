import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                topBar: '#1f185f',
                textDefault: '#ffffff'
            },
            dark: {
                /// Side Menu ///
                SideMenuBgColor: '#424242',
                SideMenuActiveButton: '#2196f3',
                /// End Side Menu///
                /// Top Bar ///
                TopBarBgColor: '#303030',
                TopBarSwichColor: "#2196f3",
                /// End Top Bar ///
                /// Nav Menu  ///
                NavMenuBgColor: '#2196f3',
                /// End Nav Menu ///
                textDefault: '#ffffff'
            },
        },
    },
});
