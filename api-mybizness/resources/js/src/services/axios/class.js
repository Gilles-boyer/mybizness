
import api from './api'

//collection of request to API for class
export default {

    getAll() {
        return api.get('class/get/all');
    },
}
