import axios from 'axios'

export default axios.create({
    //baseURL: `${location.origin}/api`,
    baseURL: `https://mybizness.herokuapp.com/api`,
    headers: {

        //'Authorization': 'Bearer ' + localStorage.getItem('token'),
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
})
