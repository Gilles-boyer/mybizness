import axios from 'axios';
import index from '../../store/index';

export default axios.create({
    baseURL: `${location.origin}/api`,
    headers: {
        'Authorization': 'Bearer ' + index.getters.token,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
})
