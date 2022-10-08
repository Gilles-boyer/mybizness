import apiFont from "../services/axios/font";
import index from "./index";

export default {
    state: {
        fontsOnline:[]
    },
    getters: {
        getFontsOnline(state) {
            return state.fontsOnline;
        }
    },
    mutations: {
        SET_FONTS_ONLINE(state, data) {
            state.fontsOnline = data;
        }
    },
    actions: {
        async initFontsOnline({commit}) {
            index.commit("SET_OVERLAY_ON");
            apiFont.getAllFontsOnline().then(res => {
                commit("SET_FONTS_ONLINE", res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()));
        }
    },
};
