import api from "./axios";

export default {
    getProductByCat() {
        return api.get(`categories/online/get`);
    },
};
