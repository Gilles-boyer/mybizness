import api from "./api";

export default {
    getAllOrder() {
        return api.get('orders/get');
    },
};
