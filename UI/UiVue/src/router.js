import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const authBlade = './components/blades/auth/';
const guestBlade = './components/blades/guest/';

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'Home',
            component: () => import('./App.vue'),
            meta: {
                auth: true
            },
            children: [
                {
                    path: '/users',
                    name: 'Users',
                    component: () => import(authBlade + 'users/Handler.vue'),
                    children: [
                        {
                            path: '/users/register',
                            name: 'Register',
                            component: () => import(authBlade + "users/register/Handler"),
                        },
                        {
                            path: '/users/edit',
                            name: 'Edit',
                            component: () => import(authBlade + "users/edit/Handler"),
                            props: true
                        },
                        {
                            path: '/users/deleted',
                            name: 'Deleted',
                            component: () => import(authBlade + "users/deleted/Handler"),
                            props: true
                        }
                    ]
                },
                {
                    path: '/events',
                    name: 'Events',
                    component: () => import(authBlade + 'event-calendar/Handler.vue'),
                },
                {
                    path: '/groups',
                    name: 'Groups',
                    component: () => import(authBlade + 'groups/Handler.vue'),
                },
                {
                    path: '/account',
                    name: 'Account',
                    component: () => import(authBlade + 'account/Handler.vue'),
                    children: [
                        {
                            path: '/account/buttons',
                            name: 'Button',
                            component: () => import(authBlade + "account/apperance/Handler"),
                        },
                        {
                            path: '/account/roles',
                            name: 'Role',
                            component: () => import(authBlade + "account/role/Handler"),
                        },
                    ]
                },
                {
                    path: '/payments',
                    name: 'Payments',
                    component: () => import(authBlade + 'payments/Handler.vue'),
                },
                {
                    path: '/exams',
                    name: 'Exams',
                    component: () => import(authBlade + 'exams/Handler.vue'),
                },
            ]
        },
        {
            path: '/login',
            name: 'Login',
            component: () => import(guestBlade + 'Handler.vue'),
            props: true,
            meta: {
                auth: false,
            },

        },
        {
            path: '/reset',
            name: 'ResetPassword',
            component: () => import(guestBlade + 'resetPassword/Handler.vue'),
            meta: {
                auth: false,
            },
        },

    ]
});