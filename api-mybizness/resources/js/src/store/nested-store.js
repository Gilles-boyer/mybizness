import apiScript from "../services/axios/script";
import index from "./index";

export default {
    state: {
        list_method: [],
    },
    mutations: {
        updateListMethod: (state, payload) => {
            state.list_method = payload;
        },
    },
    getters: {
        getListMethod: (state) => {
            return state.list_method;
        },
    },
    actions: {
        updateElements: ({ commit }, payload) => {
            payload.forEach((element, i) => {
                payload[i] = JSON.stringify(element);
            });
            apiScript.updateMethod({
                script_methods: payload
            }).then((res) => {
                commit("updateListMethod", res.data.data);
                index.commit("SET_SNACK_DATA",{
                    color: "success",
                    message: res.data.message,
                })
            }).catch((err) => {
                console.log(err.toString());
                index.commit("SET_SNACK_DATA",{
                    color: "error",
                    message: err.toString(),
                })
            });
        },
        setElements: ({ commit }, id) => {
            apiScript.getElementsScript(id).then((res) => {
                commit("updateListMethod", res.data);
                index.commit('SET_OVERLAY_OFF');
            });
        },
        updateSubScriptMethod: ({ commit },{payload, id}) => {
            payload.forEach((element, i) => {
                payload[i] = JSON.stringify(element);
            });
            apiScript.updateSubScript({
                script_methods: payload
            }, id).then((res) => {
                commit("updateListMethod", res.data);
                index.commit("SET_SNACK_DATA",{
                    color: "success",
                    message: "mis a jour effectuée",
                })
            }).catch((err) => {
                index.commit("SET_SNACK_DATA",{
                    color: "error",
                    message: err.toString(),
                })
                console.log(err.toString())
            });
        }
    },
};
