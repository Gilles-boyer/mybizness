import Vue from 'vue';
import Vuex from 'vuex';
import classMethod from './classMethod';
import snackBar from './snackBar';
import modalAddScript from './modalAddScript';
import scriptData from './script';
import nestedStore from './nested-store';
import overlay from './overlay';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    classMethod : classMethod,
    snackBar : snackBar,
    modalAddScript: modalAddScript,
    scriptData: scriptData,
    nestedStore: nestedStore,
    overlay:overlay
  }
})
