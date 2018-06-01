import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Cookies from 'js-cookie'

Vue.use(Vuex)
export const store = new Vuex.Store({
    state: {
        selCats: [],
        all: [],
        userdata: {},
        added: [],
        message: "",
    },
    getters: {
        selCats: state => state.selCats,

        allProducts: state => state.all,

        getNumberOfProducts: state => (state.all) ? state.all.length : 0,

        cartProducts: state => {
            return state.added
        },

        message: state => state.message,
    },
    mutations: {
        updateValue(state, payload) {
            state.selCats.length = 0
            state.selCats.push(payload)
        },

        setProductList: (state, {list}) => {
            state.all = list
        },

        setUserData: (state, {list}) => {
            state.userdata = list
        },

        addToCart(state, {id, title, image}) {
            const record = state.added.find(p => p.id === id)
            const prodrecord = state.all.find(p => p.id === id)
            if (!record) {
                state.added.push({
                    id,
                    title,
                    image,
                    quantity: 1
                })
                prodrecord.quantity = 1
            } else {
                record.quantity++
                prodrecord.quantity = record.quantity
            }
        },

        incrementQty(state, {id, title, image}) {
            const record = state.added.find(p => p.id === id)
            const prodrecord = state.all.find(p => p.id === id)
            if (!record) {
                state.added.push({
                    id,
                    title,
                    image,
                    quantity: 1
                })
                prodrecord.quantity = 1
            } else {
                record.quantity++
                prodrecord.quantity = record.quantity
            }
        },

        decreaseQty(state, {id}) {
            const record = state.added.find(p => p.id === id)
            const prodrecord = state.all.find(p => p.id === id)
            if (record && record.quantity > 0) {
                record.quantity--
                prodrecord.quantity = record.quantity
            } else if (!record || record.quantity === 0) {
                state.added.length = 0
            }
        },

        setQuantity(state, {id, qty}) {
            const record = state.added.find(p => p.id === id)
            const prodrecord = state.all.find(p => p.id === id)
            if (record) {
                record.quantity = qty
            } else {
                state.added.push({
                    id: prodrecord.id,
                    title: prodrecord.title,
                    image: prodrecord.image,
                    quantity: qty
                })
            }
        },

        clearBasket(state) {
            state.added = []
            state.cartProducts = []
            state.message = "Bedankt voor jouw bestelling."
        }
    },
    actions: {
        updateValue: (context, val) => {
            context.commit('updateValue', val)
        },

        loadProducts: function ({commit}) {
            axios.post('/products', this.state.selCats[0].selCats)
            .then(response => {
                    commit('setProductList', {list: response.data.products})
                }
            )
            .catch(response => console.log(response.data))
        },

        loadUserData: function ({commit}) {
            axios.post('/userdata')
            .then(response => {
                    commit('setUserData', {list: response.data.userdata})
                }
            )
            .catch(response => console.log(response.data))
        },

        checkout: function ({commit}) {
            axios.post('/checkout', {products: this.getters.cartProducts, userdata: this.state.userdata})
            .then(response => {
                    commit('clearBasket')
                }
            )
            .catch(response => console.log(response.data))
        },

        addToCart: ({commit}, product) => {
            commit('addToCart', {
                id: product.id,
                title: product.title,
                image: product.image
            })
        },

        incrementQty: ({commit}, product) => {
            commit('incrementQty', {
                id: product.id,
                title: product.title,
                image: product.image
            })
        },

        decreaseQty: ({commit}, product) => {
            commit('decreaseQty', {
                id: product.id,
                title: product.title,
                image: product.image
            })
        },

        setQuantity: ({commit}, product) => {
            commit('setQuantity', {
                id: product.id,
                qty: product.qty
            })
        }
    },
    plugins: [
        createPersistedState({
            paths: ['added', 'userdata', 'all', 'selCats'],
            storage: {
                getItem: key => Cookies.get(key),
                setItem: (key, value) => Cookies.set(key, value, {expires: 3, secure: false}),
                removeItem: key => Cookies.remove(key)
            }
        })
    ],
})
