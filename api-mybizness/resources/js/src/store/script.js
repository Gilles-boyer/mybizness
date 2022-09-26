import apiScript from "../services/axios/script";
import index from "./index";

export default {
    state: {
        scripts: [],
        selectedScript:{id:0}
    },
    getters: {
        getScripts: (state) => {
            return state.scripts;
        },
        getSelectedScript: (state) => {
            return state.selectedScript;
        }
    },
    mutations: {
        SET_SCRIPTS_PUSH(state, data) {
            state.scripts.push(data);
        },
        SET_SCRIPTS(state, data) {
            state.scripts = data;
        },
        SET_SELECTED_SCRIPT(state, data) {
            state.selectedScript = data;
        }
    },
    actions: {
        pushScripts: async function (context, data) {
            try {
                var res = await apiScript.store({
                    name: data.name,
                    description: data.description
                })
                context.commit("SET_SCRIPTS_PUSH", res.data.data);

                return {
                    success : true,
                    message : res.data.message
                }
            }catch(e){
                return {
                    success : false,
                    message : e.message
                }
            }
        },
        loadAllScript: function (context) {
            apiScript.getAll()
            .then(res => {
                context.commit("SET_SCRIPTS", res.data.data)
                index.commit("SET_OVERLAY_OFF");
            })
            .catch(err => console.log(err.toString()));
        },
        setSelectedScript: function (context, data) {
            context.commit("SET_SELECTED_SCRIPT", data)
        }
    },
};
