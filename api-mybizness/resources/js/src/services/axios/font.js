import api from "./api";

export default {
    getAllFontsOnline() {
        return api.get('fonts/online/get');
    },
    getAllFonts() {
        return api.get('fonts');
    },
    storeNewFont(data) {
        return api.post('font/store', data);
    },
    updateFont(id, data) {
        return api.put(`font/${id}/update`, data);
    },
    deleteFont(id) {
        return api.delete(`font/${id}/delete`);
    },
    updateFontOnline(id) {
        return api.put(`font/${id}/online`);
    }
};
