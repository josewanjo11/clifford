require('./bootstrap');

import {createApp,ref} from 'vue'
import * as VueRouter from 'vue-router'

import HomeComponent from './components/HomeComponent.vue'
import DashboardComponent from './components/DashboardComponent.vue'

import store from './store'
const app = createApp({})
app.use(store)
const routes = [
    {path: '/', component: HomeComponent},
    {path: '/dashboard',name: 'dashboard', component: DashboardComponent},
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('/'),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
})



window.url = '/'

app.use(router)

app.mount('#app')
