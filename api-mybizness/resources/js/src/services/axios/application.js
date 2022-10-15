import api from "./api";

export default {

    updateAppACL(appId, methodId) {
        var data = {
            app_id  : appId,
            method_id: methodId
        }
        return api.put('appmethod/update/relation', data);
    },

    getAllApps() {
        return api.get('applications');
    },
    storeNewApp(data) {
        return api.post('application/store', data);
    },
    updateApp(id, data) {
        return api.put(`application/${id}/update`, data);
    },
    deleteApp(id) {
        return api.delete(`application/${id}/delete`);
    },
    updateAppActivate(id) {
        return api.put(`application/${id}/activate`);
    },
    checkTokenExist(token) {
        return api.post('application/password/reset', token)
    },
    updateUserPassword(data) {
        return api.post('user/reset/password', data)
    }
};
