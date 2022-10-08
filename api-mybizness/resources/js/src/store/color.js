import apiColor from "../services/axios/color";
import index from "./index";

export default {
    state: {
        colorsOnline:[]
    },
    getters: {
        getColorsOnline(state) {
            return state.colorsOnline;
        }
    },
    mutations: {
        SET_COLORS_ONLINE(state, data) {
            state.colorsOnline = data;
        }
    },
    actions: {
        async initColorsOnline({commit}) {
            index.commit("SET_OVERLAY_ON");
            apiColor.getAllColorsOnline().then(res => {
                commit("SET_COLORS_ONLINE", res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()));
        }
    },
};
