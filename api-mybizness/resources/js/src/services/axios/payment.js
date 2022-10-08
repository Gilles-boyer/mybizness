import api from "./api";

export default {
    getAllTypePayment() {
        return api.get('payments/online/get');
    },
};
