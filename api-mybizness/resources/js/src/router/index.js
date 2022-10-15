import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import Script from '../views/Script.vue';
import Order from '../views/Order.vue';
import User from '../views/User.vue';
import Application from '../views/Application.vue';
import Login from '../views/Login.vue';
import ResetPassword from '../views/ResetPassword.vue';
import store from '../store/index.js';

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'Home',
    meta: {
      middleware: "auth"
  },
  },
  {
    path: '/script',
    name: 'Script',
    component: Script,
    meta: {
      middleware: "auth"
    },
  },
  {
    path: '/order',
    name: 'Order',
    component: Order,
    meta: {
      middleware: "auth"
  },
  },
  {
    path: '/user',
    name: 'User',
    component: User,
    meta: {
      middleware: "auth"
  },
  },
  {
    path: '/application',
    name: 'Application',
    component: Application,
    meta: {
      middleware: "auth"
  },
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      middleware: "guest",
      title: `Login`
    }
  },
  {
    path: '/reset/password/:token',
    name: 'ResetPassword',
    component: ResetPassword,
    meta: {
      middleware: "guest",
      title: `ResetPassword`
    }
  },

]

const router = new VueRouter({
  mode: 'history',
  base: 'app',
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  if (to.meta.middleware == "guest") { 
      if (store.getters.authenticated) {
          next({ name: "Home" })
      }
      next()
  } else {
      if (store.getters.authenticated) {
          next()
      } else {
          next({ name: "Login" })
      }
  }
})

export default router
