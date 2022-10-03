import api from "./axios";

export default {
    getFonts() {
        return api.get(`fonts/online/get`);
    },
};
