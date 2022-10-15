import Vue from 'vue';
import Vuex from 'vuex';
import classMethod from './classMethod';
import snackBar from './snackBar';
import modalAddScript from './modalAddScript';
import scriptData from './script';
import nestedStore from './nested-store';
import overlay from './overlay';
import order from './order';
import catOnline from './category';
import image from './image';
import font from './font';
import color from './color';
import shipping from './shipping';
import step1 from './step1';
import step2 from './step2';
import step3 from './step3';
import payment from './payment';
import login from './login';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [createPersistedState()],
  modules: {
    classMethod : classMethod,
    snackBar : snackBar,
    modalAddScript: modalAddScript,
    scriptData: scriptData,
    nestedStore: nestedStore,
    overlay:overlay,
    order:order,
    catOnline:catOnline,
    image:image,
    font:font,
    color:color,
    shipping:shipping,
    step1:step1,
    step2:step2,
    step3:step3,
    payment:payment,
    login:login
  }
})
