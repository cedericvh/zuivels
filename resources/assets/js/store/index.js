import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'
import auth from './modules/auth'
import products from './modules/products'
import cart from './modules/cart'
import categories from './modules/categories'
import alert from './modules/alert'
import shippingrounds from './modules/shippingrounds'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        auth,
        products,
        cart,
        categories,
        alert,
        shippingrounds
    },
    strict: debug,
    plugins: [
        createPersistedState({
            storage: {
                getItem: key => Cookies.get(key),
                setItem: (key, value) => Cookies.set(key, value, {
                    expires: 3,
                    secure: process.env.NODE_ENV === 'production'
                }),
                removeItem: key => Cookies.remove(key)
            },
            paths: ['cart', 'categories', 'products', 'auth']
        })
    ]
})
