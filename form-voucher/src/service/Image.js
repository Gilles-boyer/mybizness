import api from "./axios";

export default {
    getImages() {
        return api.get(`images/online/get`);
    },
};
