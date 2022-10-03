import axios from 'axios'

export default axios.create({
    //baseURL: `${location.origin}/api`,
    baseURL: `http://localhost:8000/api`,
    headers: {

        //'Authorization': 'Bearer ' + localStorage.getItem('token'),
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
})
