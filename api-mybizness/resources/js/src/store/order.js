import apiOrder from "../services/axios/order";

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
        }
    },
    actions: {
        async initOrders({commit}) {
            var res = await apiOrder.getAllOrder()
            commit("SET_ORDERS", res.data.data);
        }
    },
};
