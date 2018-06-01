// initial state
const state = {
    added: [],
}

// getters
const getters = {
    cartProducts: (state, getters, rootState) => {
        return state.added.map(({id, quantity}) => {
            const product = rootState.products.all.find(product => product.id === id)
            return {
                id,
                title: product.title,
                image: product.image,
                quantity
            }
        })
    },
    cartProductsQuantity: (state) => {
        let count = 0
        for (let item of state.added) {
            count += item.quantity
        }
        return count
    }
}

// actions
const actions = {
    addProductToCart({state, commit}, product) {
        const cartItem = state.added.find(item => item.id === product.id)
        if (!cartItem) {
            commit('pushProductToCart', {id: product.id})
        } else {
            commit('incrementItemQuantity', cartItem)
        }
    },
    decreaseItemQuantity({state, commit}, product) {
        const cartItem = state.added.find(item => item.id === product.id)
        if (cartItem && cartItem.quantity > 0) {
            commit('decreaseItemQuantity', {id: product.id})
        }
    },
}

// mutations
const mutations = {
    pushProductToCart(state, {id}) {
        state.added.push({
            id,
            quantity: 1
        })
    },

    incrementItemQuantity(state, {id}) {
        const cartItem = state.added.find(item => item.id === id)
        cartItem.quantity++
    },

    decreaseItemQuantity(state, {id}) {
        const cartItem = state.added.find(item => item.id === id)
        cartItem.quantity--
        if (cartItem.quantity <= 0) state.added.splice(state.added.findIndex(item => item.id === id), 1)
    },

    setCartItems(state, {items}) {
        state.added = items
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}