// initial state
const state = {
    accessToken: '',
    user: null
}

// getters
const getters = {
    accessToken: state => state.accessToken,
    user: state => state.user,
}

// actions
const actions = {
    setAccessToken ({ commit, state }, accessToken) {
        commit('setAccessToken', accessToken)
    },
    destroyAccessToken ({ commit, state }) {
        commit('setAccessToken', '')
    },
    setUser ({ commit, state }, user) {
        commit('setUser', user)
    },
    destroyUser({commit, state}) {
        commit('setUser', null)
    }
}

// mutations
const mutations = {
    setAccessToken (state, accessToken) {
        state.accessToken = accessToken
    },
    setUser (state, user) {
        state.user = user
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}