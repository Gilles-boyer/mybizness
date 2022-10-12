import api from "./api";

export default {
    getAllUsers() {
        return api.get(`users`);
    },
    storeNewUser(data) {
        return api.post('user/store', data);
    },
    deleteUser(id) {
        return api.delete(`user/${id}/delete`);
    },
    updateUser(id, data) {
        return api.put(`user/${id}/update`, data);
    },
};
