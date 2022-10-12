import api from "./api";

export default {
    getAllRole() {
        return api.get(`role/get/all`);
    },

    updateRoleACL(roleId, methodId) {
        var data = {
            role_id  : roleId,
            method_id: methodId
        }
        return api.put('rolemethod/update/relation', data);
    },
    storeNewRole(data) {
        return api.post('role/create', data);
    },
    updateRole(id, data) {
        return api.put(`role/update/${id}`, data);
    },
    deleteRole(id) {
        return api.delete(`role/${id}/delete`);
    },

};
