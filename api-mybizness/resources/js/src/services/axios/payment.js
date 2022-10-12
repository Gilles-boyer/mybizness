import api from "./api";

export default {
    getAllTypePayment() {
        return api.get('payments/online/get');
    },
    storeNewPayment(data) {
        return api.post('payment/store', data);
    },
    updatePayment(id, data) {
        return api.put(`payment/${id}/update`, data);
    },
    deletePayment(id) {
        return api.delete(`payment/${id}/delete`);
    },
};
