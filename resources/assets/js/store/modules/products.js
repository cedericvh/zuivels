// initial state
const state = {
    all: [],
    filtered: [],
    paginateData: {
        current_page: 0,
        first_page_url: "",
        from: 0,
        last_page: 0,
        last_page_url: "",
        next_page_url: "",
        path: "",
        per_page: 0,
        prev_page_url: null,
        to: 0,
        total: 0
    }
}

// getters
const getters = {
    allProducts: state => state.all,
    filteredProducts: state => state.filtered,
    paginateData: state => state.paginateData
}

// actions
const actions = {
    getAllProducts({commit}) {
        axios.get(`/products`).then(response => {
            commit('setProducts', response.data.products)
            // delete response.data.products.data
            // commit('setPaginateData', response.data.products)
        })
    },
    getFilteredProducts({commit}, selectedCategories) {
        axios.get('/products', {
            params: {
                categories: selectedCategories
            }
        }).then(response => {
            commit('setFiltered', response.data.products)
        })
    },
    sort({commit}, products) {
        commit('setProducts', products)
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
    setPaginateData(state, paginateData) {
        state.paginateData = paginateData
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}