import Vue from 'vue'
import VueRouter from 'vue-router'

import Signup from '../components/auth/Signup.vue'
import Signin from '../components/auth/Signin.vue'
import Email from '../components/auth/password/Email.vue'
import Reset from '../components/auth/password/Reset.vue'
import Home from './../../app/components/Home.vue'
import Notifiable from './../../app/components/notifiable/Index.vue'
import NotifiableCreate from './../../app/components/notifiable/Create.vue'
import NotifiableEdit from './../../app/components/notifiable/Edit.vue'

Vue.use(VueRouter)

const router = new VueRouter({
        routes: [
            {
                path: '/signup',
                name: 'signup',
                component: Signup,
                meta: {
                    auth: false
                }
            },
            {
                path: '/signin',
                name: 'signin',
                component: Signin,
                meta: {
                    auth: false
                }
            },
            {
                path: '/email/send',
                name: 'email',
                component: Email,
                meta: {
                    auth: false
                }
            },
            {
                path: '/password/find/:token',
                name: 'reset',
                component: Reset,
                meta: {
                    auth: false
                }
            },
            {
                path: '/',
                name: 'home',
                component: Home,
                meta: {
                    auth: true
                }
            },
            {
                path: '/notifiables',
                name: 'Notifiable',
                component: Notifiable,
                meta: {
                    auth: true
                }
            },
            {
                path: '/notifiables/create',
                name: 'NotifiableCreate',
                component: NotifiableCreate,
                meta: {
                    auth: true
                }
            },
            {
                path: '/notifiables/:id/edit',
                name: 'NotifiableEdit',
                component: NotifiableEdit,
                meta: {
                    auth: true
                }
            }
        ]
});

import beforeEach from './beforeEach'

router.beforeEach(beforeEach)

export default router
