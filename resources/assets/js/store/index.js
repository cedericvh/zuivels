import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from './modules/auth'
import products from './modules/products'
import cart from './modules/cart'
import categories from './modules/categories'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        auth,
        products,
        cart,
        categories,
    },
    strict: debug,
    plugins: [
        createPersistedState({
            storage: window.sessionStorage
        })
    ],
})