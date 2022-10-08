import api from "./api";

export default {
    getAllColorsOnline() {
        return api.get('colors/online/get');
    },
};
