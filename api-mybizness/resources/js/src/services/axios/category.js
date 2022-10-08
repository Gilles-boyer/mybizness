import api from "./api";

export default {
    getAllCategoryProdOnline() {
        return api.get(`categories/online/get`);
    },
};
