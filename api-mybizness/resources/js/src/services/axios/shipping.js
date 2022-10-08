import api from "./api";

export default {
    getAllShippingsOnline() {
        return api.get('shippings/online/get');
    },
};
