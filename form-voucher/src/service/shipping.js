import api from "./axios";

export default {
    getShipping() {
        return api.get(`shippings/online/get`);
    },
};
