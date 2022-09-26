export default {
    state: {
        overlay: false,
    },
    getters: {
        getOverlay: (state) => {
            return state.overlay;
        },
    },
    mutations: {
        SET_OVERLAY_ON(state) {
            state.overlay = true;
        },
        SET_OVERLAY_OFF(state) {
            state.overlay = false;
        }
    },
    actions: {
        openOverlay({commit}) {
            commit("SET_OVERLAY_ON");
        },
        closeOverlay({commit}) {
            commit("SET_OVERLAY_OFF");
        }
    },
};
