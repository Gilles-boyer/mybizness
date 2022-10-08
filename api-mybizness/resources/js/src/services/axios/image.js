import api from "./api";

export default {
    getAllImageOnline() {
        return api.get('images/online/get');
    },
};
