import api from "./api";

export default {
    getAllFontsOnline() {
        return api.get('fonts/online/get');
    },
};
