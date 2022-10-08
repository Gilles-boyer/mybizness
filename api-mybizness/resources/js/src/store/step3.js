export default {
    state: {
        customerStep3: {
            firstName: "",
            lastName: "",
            tel: "",
            email: "",
        },
        beneficiaryStep3: {
            firstName: "",
            lastName: "",
            tel: "",
            email: "",
        },
        shippingStep3: "",
        paymentStep3: "",
        checkboxStep3: false,
        formStep3Reset: () => {},
    },
    getters: {
        getCustomerStep3(state) {
            return state.customerStep3;
        },
        getBeneficiaryStep3(state) {
            return state.beneficiaryStep3;
        },
        getShippingStep3(state) {
            return state.shippingStep3;
        },
        getCheckboxStep3(state) {
            return state.checkboxStep3;
        },
        getPaymentStep3(state) {
            return state.paymentStep3;
        },
    },
    mutations: {
        SET_SHIPPING_STEP3(state, data) {
            state.shippingStep3 = data;
        },
        SET_PAYMENT_STEP3(state, data) {
            state.paymentStep3 = data;
        },
        SET_FORM_STEP3(state, data) {
            state.formStep3Reset = data;
        },
        CLEAR_FORM_STEP3(state) {
            state.customerStep3 = {
                firstName: "",
                lastName: "",
                tel: "",
                email: "",
            }
            state.beneficiaryStep3 = {
                firstName: "",
                lastName: "",
                tel: "",
                email: "",
            }
            state.shippingStep3 = "";
            state.paymentStep3 = "";
            state.checkboxStep3 = false;
            state.formStep3Reset.resetValidation();
        },
        SET_STEP3_SAME(state) {
            state.beneficiaryStep3 = state.customerStep3;
        },
        SET_CHECKBOX_STEP3(state, data) {
            state.checkboxStep3 = data;
        }
    },
    actions: {
        setShippingStep3({ commit }, value) {
            commit("SET_SHIPPING_STEP3", value);
        },
        setPaymentStep3({commit}, value) {
            commit("SET_PAYMENT_STEP3", value);
        },
        setFormStep3({ commit }, value) {
            commit("SET_FORM_STEP3", value);
        },
        clearFormStep3({commit}) {
            commit('CLEAR_FORM_STEP3');
        },
        setBeneSameCust({commit}) {
            commit('SET_STEP3_SAME');
        },
        setCheckboxStep3({commit}, data) {
            commit('SET_CHECKBOX_STEP3', data);
        }
    },
};
