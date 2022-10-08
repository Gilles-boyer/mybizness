import apiCat from "../services/axios/category";
import index from "./index";

export default {
    state: {
        categoriesOnline:[]
    },
    getters: {
        getCatOnline(state) {
            return state.categoriesOnline;
        }
    },
    mutations: {
        SET_CAT_ONLINE(state, data) {
            state.categoriesOnline = data;
        },
        RESET_CAT_ONLINE(state) {
            state.categoriesOnline.forEach(item => {
                item.active = false;
            })
        }
    },
    actions: {
        async initCatOnline({commit}) {
            index.commit("SET_OVERLAY_ON");
            apiCat.getAllCategoryProdOnline().then(res => {
                commit("SET_CAT_ONLINE", res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()));
        },
        resetCatStep1({commit}) {
            commit('RESET_CAT_ONLINE')
        }
    },
};
