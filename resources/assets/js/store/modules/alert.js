// initial state
const state = {
    alert: {
        type: '',
        title: '',
        message: ''
    }
}

// getters
const getters = {
    alert: (state) => {
        return state.alert
    }
}

// actions
const actions = {
    setAlert({commit, state, dispatch}, message, type = 'success', title = '') {
        commit('setAlert', {alert: {type, title, message}})
        setTimeout(() => dispatch('clearAlert'), 6000)
    },
    clearAlert({commit}) {
        commit('setAlert', {alert: {type: '', title: '', message: ''}})
    }
}

// mutations
const mutations = {
    setAlert(state, {alert}) {
        state.alert = alert
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}