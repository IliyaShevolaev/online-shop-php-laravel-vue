import { createStore } from 'vuex'

const store = createStore({
    state() {
        return {
            productsFromFilter: null,
            filterKey: 0,
        };
    },

    mutations: {
        setProductsFromFilter(state, products) {
            state.productsFromFilter = products;
        },
        incrementFilterKey(state) {
            state.filterKey++;
        },
    },
})

export default store