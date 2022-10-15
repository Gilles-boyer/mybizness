import router from '../router'
import apiUser from '../services/axios/user';
import index from "./index";

export default {
    state:{
        authenticated:false,
        user:{},
        token:""
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        },
        token(state){
            return state.token
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_USER (state, value) {
            state.user = value
        },
        SET_TOKEN (state, value) {
            state.token = value
        }
    },
    actions:{
        login({commit}, login){
            index.commit("SET_OVERLAY_ON");
            apiUser.login(login).then(res => {
                res.data.data
                commit('SET_TOKEN', res.data.data.token)
                commit('SET_USER', {
                    id: res.data.data.id,
                    name: res.data.data.name
                })
                commit('SET_AUTHENTICATED', true)
                index.commit("SET_OVERLAY_OFF");
                router.push('/home');
            }).catch(err => {
                console.log(err.toString());
            })
        },
        logout({commit}){
            apiUser.logout().then(res => {
                commit('SET_USER',{})
                commit('SET_TOKEN',"")
                commit('SET_AUTHENTICATED',false)
                window.localStorage.clear();
                router.push('/login');
            }).catch(err => {
                console.log(err.toString());
            })
        }
    }
}