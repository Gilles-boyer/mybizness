import api from "./api";

export default {
    getAllColorsOnline() {
        return api.get('colors/online/get');
    },
    getAllColors() {
        return api.get('colors');
    },
    storeNewColor(data) {
        return api.post('color/store', data);
    },
    updateColor(id, data) {
        return api.put(`color/${id}/update`, data);
    },
    deleteColor(id) {
        return api.delete(`color/${id}/delete`);
    },
    updateColorOnline(id) {
        return api.put(`color/${id}/online`);
    }
};
