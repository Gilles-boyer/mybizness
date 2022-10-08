
import apiPayment from "../services/axios/payment";
import index from "./index";

export default {
    state: {
        payments: [],
    },
    getters: {
        getPayments(state) {
            return state.payments;
        },
    },
    mutations: {
        SET_PAYMENTS(state, data) {
            state.payments = data;
        },
    },
    actions: {
        async initPayments({ commit }) {
            index.commit("SET_OVERLAY_ON");
            apiPayment.getAllTypePayment()
                .then((res) => {
                    commit("SET_PAYMENTS", res.data.data);
                    index.commit("SET_OVERLAY_OFF");
                })
                .catch((err) => console.log(err.toString()));
        },
    },
};
