// initial state
const state = {
    selected: []
}

// getters
const getters = {
    selectedCategories: state => state.selected
}

// actions
const actions = {
    setCategories({commit}, categories) {
        commit('setCategories', categories)
    }
}

// mutations
const mutations = {
    setCategories(state, categories) {
        state.selected = categories
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}