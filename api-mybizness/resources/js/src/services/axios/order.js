import api from "./api";

export default {
    getAllOrder() {
        return api.get('orders/get');
    },
    deleteOrder(id) {
        return api.delete(`order/delete/${id}`);
    }
};
