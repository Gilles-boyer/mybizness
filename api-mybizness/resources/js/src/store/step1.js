export default {
    state: {
        gifts:[]
    },
    getters: {
        getGifts(state) {
            return state.gifts;
        },
        getGiftsId(state) {
            var tab = [];
            state.gifts.forEach(item =>{
                tab.push(item.id);
            });
            return tab;
        },
        getTotalGifts(state) {
            var total = 0;
            state.gifts.forEach((item) => {
                total += parseInt(item.price);
            })
            return total
        }
    },
    mutations: {
        SET_CLEAR_GIFT(state) {
            state.gifts = [];
        },
        PUSH_GIFT(state, data) {
            state.gifts.push(data)
        },
        DELETE_GIFT(state, index) {
            state.gifts.splice(index, 1);
        }
    },
    actions: {
        clearGifts({commit}) {
            commit('SET_CLEAR_GIFT');
        },
        addGift({commit}, gift) {
            commit('PUSH_GIFT', gift);
        },
        deleteGift({commit}, index) {
            commit('DELETE_GIFT', index)
        }
    },
};
