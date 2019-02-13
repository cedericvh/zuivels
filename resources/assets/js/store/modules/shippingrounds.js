// initial state
const state = {
    all: [],

}

// getters
const getters = {
    allShippingrounds: state => state.all,
    
}

// actions
const actions = {
    getAllShippingrounds({commit}) {
        axios.get(`/shippingrounds`).then(response => {
            commit('setShippingrounds', response.data.shippingrounds)
            // delete response.data.products.data
            //commit('setPaginateData', response.data.shippingrounds)
        })
    },
    sort({commit}, shippingrounds) {
        commit('setShippingrounds', shippingrounds)
    },
}

// mutations
const mutations = {
    setShippingrounds(state, shippingrounds) {
        state.all = shippingrounds
    },
    
  
}

export default {
    state,
    getters,
    actions,
    mutations
}