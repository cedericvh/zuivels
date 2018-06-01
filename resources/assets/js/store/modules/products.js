// initial state
const state = {
    all: [],
    filtered: []
}

// getters
const getters = {
    allProducts: state => state.all,
    filteredProducts: state => state.filtered
}

// actions
const actions = {
    getAllProducts({commit}) {
        axios.get('/products').then(response => {
            commit('setProducts', response.data.products)
        })
    },
    getFilteredProducts({commit}, selectedCategories) {
        axios.get('/products', {
            params: selectedCategories
        }).then(response => {
            commit('setFiltered', response.data.products)
        })
    },
}

// mutations
const mutations = {
    setProducts(state, products) {
        state.all = products
    },
    setFiltered(state, products) {
        state.filtered = products
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}