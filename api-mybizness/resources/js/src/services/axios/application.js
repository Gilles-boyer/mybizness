import api from "./api";

export default {

    updateAppACL(appId, methodId) {
        var data = {
            app_id  : appId,
            method_id: methodId
        }
        return api.put('appmethod/update/relation', data);
    }
};
