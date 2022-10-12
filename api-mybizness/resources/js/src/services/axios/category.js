import api from "./api";

export default {
    getAllCategoryProdOnline() {
        return api.get(`categories/online/get`);
    },
    getAllCategories() {
        return api.get('categories');
    },
    storeNewCategory(data) {
        return api.post('category/store', data);
    },
    updateCategory(id, data) {
        return api.put(`category/${id}/update`, data);
    },
    deleteCategory(id) {
        return api.delete(`category/${id}/delete`);
    },
};
