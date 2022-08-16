import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    users: [],
  },
  getters: {
    getUsers: state => {
      return state.users
    }
  },
  mutations: {
    SET_USERS(state, data) {
      state.users = data;
    },
  },
  actions: {
    updateUser(context, data) {
      context.commit('SET_USERS',  [
        {
          firstName: "gilles",
          lastName: "boyer",
          mail: "boyer.gilles@live.fr",
          tel : "0692084084"
        }
      ])
    },
  },
  modules: {
  }
})
