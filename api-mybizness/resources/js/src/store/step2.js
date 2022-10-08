export default {
    state: {
        personalization: {
            color: { name: "Bleu", hex: "primary" },
            font: { name: "roboto", font: "roboto" },
            image: {
                name: "eadydrift",
                src: "https://www.autonocion.com/wp-content/uploads/2014/05/easydrift-megane-rs-778x500.jpg",
                description: "easydrift",
            },
            message: "votre message",
        },
        validStep2: true,
        resetStep2: () => {},
    },
    getters: {
        getPersonalization(state) {
            return state.personalization;
        },
        getValidStep2(state) {
            return state.validStep2;
        },
        getResetStep2(state) {
            return state.resetStep2;
        },
    },
    mutations: {
        SET_PERSONALIZATION_IMAGE(state, image) {
            state.personalization.image = image;
        },
        SET_PERSONALIZATION_COLOR(state, color) {
            state.personalization.color = color;
        },
        SET_PERSONALIZATION_FONT(state, font) {
            state.personalization.font = font;
        },
        SET_PERSONALIZATION_MESSAGE(state, message) {
            state.personalization.message = message;
        },
        RESET_PERSONALIZATION(state) {
            state.personalization = {};
        },
        SET_RESET_STEP2(state, data) {
            state.resetStep2 = data;
        },
        SET_VALID_STEP2(state, data) {
            state.validStep2 = data;
        },
        CLEAR_PERSONALIZATION(state) {
            state.personalization = {
                color: { name: "Bleu", hex: "primary" },
                font: { name: "roboto", font: "roboto" },
                image: {
                    name: "eadydrift",
                    src: "https://www.autonocion.com/wp-content/uploads/2014/05/easydrift-megane-rs-778x500.jpg",
                    description: "easydrift",
                },
                message: "votre message",
            };
            state.resetStep2.resetValidation();
        },
    },
    actions: {
        setResetStep2({ commit }, data) {
            commit("SET_RESET_STEP2", data);
        },
        setValidStep2({ commit }, data) {
            commit("SET_VALID_STEP2", data);
        },
        setMessageStep2({ commit }, data) {
            commit("SET_PERSONALIZATION_MESSAGE", data);
        },
        setImageStep2({ commit }, data) {
            commit("SET_PERSONALIZATION_IMAGE", data);
        },
        setFontStep2({ commit }, data) {
            commit("SET_PERSONALIZATION_FONT", data);
        },
        setColorStep2({ commit }, data) {
            commit("SET_PERSONALIZATION_COLOR", data);
        },
        clearPersonalization({ commit }) {
            commit("CLEAR_PERSONALIZATION");
        },
    },
};
