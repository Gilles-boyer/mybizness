import apiImage from "../services/axios/image";
import index from "./index";

export default {
    state: {
        imagesOnline:[]
    },
    getters: {
        getImagesOnline(state) {
            return state.imagesOnline;
        }
    },
    mutations: {
        SET_IMAGES_ONLINE(state, data) {
            state.imagesOnline = data;
        }
    },
    actions: {
        async initImagesOnline({commit}) {
            index.commit("SET_OVERLAY_ON");
            apiImage.getAllImageOnline().then(res => {
                commit("SET_IMAGES_ONLINE", res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()));
        }
    },
};
