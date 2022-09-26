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
    }
};
