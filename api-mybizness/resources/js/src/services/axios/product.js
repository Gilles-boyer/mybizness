import api from "./api";

export default {
    getAllProducts() {
        return api.get('products');
    },
    storeNewProduct(data) {
        return api.post('product/store', data);
    },
    updateProduct(id, data) {
        return api.put(`product/${id}/update`, data);
    },
    deleteProduct(id) {
        return api.delete(`product/${id}/delete`);
    },
    updateProductOnline(id) {
        return api.put(`product/${id}/online`);
    }
};
