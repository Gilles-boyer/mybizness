import api from "./axios";

export default {
    getColors() {
        return api.get(`colors/online/get`);
    },
};
