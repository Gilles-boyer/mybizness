import api from './api'

export default {

    getAll() {
        return api.get('script/get/all');
    },
    store(script) {
        return api.post('script/create', script);
    },
    deleteScript(id) {
        return api.delete("script/delete", {
            data: {
                model: "Script",
                id: id,
            },
        });
    },
    updateMethod(scriptMethods)
    {
        return api.post("method/script/create", scriptMethods);
    },
    deleteMethod(id)
    {
        return api.delete(`method/script/delete/${id}`)
    },
    getElementsScript(id)
    {
        return api.get(`method/script/get/${id}`);
    },
    updateSubScript(data, id)
    {
        return api.post(`method/script/update/${id}`, data);
    }
}
