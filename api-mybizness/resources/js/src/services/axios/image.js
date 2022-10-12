import api from "./api";

export default {
    getAllImageOnline() {
        return api.get('images/online/get');
    },
    getAllImages() {
        return api.get('images');
    },
    storeNewImages(data) {
        return api.post('image/store', data);
    },
    updateImage(id, data) {
        return api.put(`image/${id}/update`, data);
    },
    deleteImage(id) {
        return api.delete(`image/${id}/delete`);
    },
    updateImageOnline(id) {
        return api.put(`image/${id}/online`);
    }
};
