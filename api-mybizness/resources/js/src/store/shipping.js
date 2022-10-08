import apiShipping from "../services/axios/shipping";
import index from "./index";

export default {
    state: {
        ShippingsOnline: [],
    },
    getters: {
        getShippingsOnline(state) {
            return state.ShippingsOnline;
        },
    },
    mutations: {
        SET_SHIPPING_ONLINE(state, data) {
            state.ShippingsOnline = data;
        },
    },
    actions: {
        async initShippingsOnline({ commit }) {
            index.commit("SET_OVERLAY_ON");
            apiShipping
                .getAllShippingsOnline()
                .then((res) => {
                    commit("SET_SHIPPING_ONLINE", res.data.data);
                    index.commit("SET_OVERLAY_OFF");
                })
                .catch((err) => console.log(err.toString()));
        },
    },
};
