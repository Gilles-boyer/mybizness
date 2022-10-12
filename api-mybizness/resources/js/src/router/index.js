import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import Script from '../views/Script.vue';
import Order from '../views/Order.vue';
import User from '../views/User.vue';
import Application from '../views/Application.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/script',
    name: 'Script',
    component: Script
  },
  {
    path: '/order',
    name: 'Order',
    component: Order
  },
  {
    path: '/user',
    name: 'User',
    component: User
  },
  {
    path: '/application',
    name: 'Application',
    component: Application
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
