import apiClass from "../services/axios/class";

export default {
    state: {
        classMethod: [],
    },
    getters: {
        getClassMethod: (state) => {
            return state.classMethod;
        },
    },
    mutations: {
        SET_CLASS_METHOD(state, data) {
            state.classMethod = data;
        },
    },
    actions: {
        getAllClassMethod: function (context) {
            apiClass
                .getAll()
                .then((res) =>
                    context.commit("SET_CLASS_METHOD", res.data.data)
                )
                .catch((err) => console.log(err));
        },
    },
};
