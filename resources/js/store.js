import { createStore } from 'vuex'

const store = createStore({
    state() {
        return {
            productsFromFilter: null,
        }
    },
})

export default store