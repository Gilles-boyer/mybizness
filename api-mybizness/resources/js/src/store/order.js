import apiOrder from "../services/axios/order";
import apiVoucher from "../services/axios/voucher";
import index from "./index";

export default {
    state: {
        orders:[]
    },
    getters: {
        getOrders(state) {
            return state.orders;
        }
    },
    mutations: {
        SET_ORDERS(state, data) {
            state.orders = data;
        },
        PUSH_ORDER(state, data) {
            state.orders.push(data);
        },
        DELETE_ORDER_INDEX(state, index) {
            state.orders.splice(index, 1);
        }
    },
    actions: {
        async initOrders({commit}) {
            index.commit("SET_OVERLAY_ON");
            apiOrder.getAllOrder().then(res => {
                commit("SET_ORDERS", res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()));
        },
        newOrders({commit}, data) {
            index.commit("SET_OVERLAY_ON");
            apiVoucher.createVoucher(data).then(res =>{
                console.log(res)
                commit('PUSH_ORDER', res.data.data);
                index.commit("SET_OVERLAY_OFF");
            }).catch(err => console.log(err.toString()))
        },
        deleteOrder({commit}, data) {
            index.commit("SET_OVERLAY_ON");
            apiOrder.deleteOrder(data.id).then(res =>{
                commit("DELETE_ORDER_INDEX", data.index);
                index.commit("SET_SNACK_DATA", {
                    message: "commande voucher effacé",
                    color:"success"
                });
                index.commit("SET_OVERLAY_OFF");
            });
        }
    },
};
