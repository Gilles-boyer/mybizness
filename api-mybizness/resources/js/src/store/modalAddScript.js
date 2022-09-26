export default {
    state: {
        scriptDialog: {
            dialog: false,
            title:"",
            name:"",
            description:"",
            list_method: []
        }
    },
    getters: {
        getScriptDialog: (state) => {
            return state.scriptDialog;
        },
    },
    mutations: {
        SET_OPEN_NEW_SCRIPT_DIALOG(state, data) {
            state.scriptDialog.dialog = true;
            state.scriptDialog.title = data.title
        },
    },
    actions: {
        openScriptDialog: function (context, data) {
            context.commit("SET_OPEN_NEW_SCRIPT_DIALOG", data);
        },
    },
};
