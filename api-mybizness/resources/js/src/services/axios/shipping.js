import api from "./api";

export default {
    getAllShippingsOnline() {
        return api.get('shippings/online/get');
    },
    getAllShipping() {
        return api.get('shippings');
    },
    storeNewShipping(data) {
        return api.post('shipping/store', data);
    },
    updateShipping(id, data) {
        return api.put(`shipping/${id}/update`, data);
    },
    deleteShipping(id) {
        return api.delete(`shipping/${id}/delete`);
    },
    updateShippingOnline(id) {
        return api.put(`shipping/${id}/online`);
    }
};
