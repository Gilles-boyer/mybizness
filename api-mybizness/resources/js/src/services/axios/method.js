import api from "./api";

export default {
    getMethodAvaible(class_name) {
        return api.get(`class/${class_name}/get/methods`);
    },
    updatePermission(role_id, method_id) {
        var data = {
            method_id: method_id,
            role_id: role_id
        }
        return api.put("rolemethod/update/relation", data);
    }
};
