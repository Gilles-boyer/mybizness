export default {
    state: {
        snackData: {
            snackbar: false,
            text: "",
            timeout: 2000,
            color: "error",
        },
    },
    getters: {
        getSnackData: (state) => {
            return state.snackData;
        },
    },
    mutations: {
        SET_SNACK_DATA(state, {message, color}) {
            state.snackData.text = message;
            state.snackData.color = color;
            state.snackData.snackbar = true;
        },
    },
    actions: {
        openSnack: function (context, data) {
            context.commit("SET_SNACK_DATA", data);
        },
    },
};
