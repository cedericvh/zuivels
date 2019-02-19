// initial state
const state = {
    accessToken: '',
    user: null
}

// getters
const getters = {
    accessToken: state => state.accessToken,
    user: state => state.user
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
    destroyUser ({ commit, state }) {
        commit('setUser', null)
    },

    fetchData ({ commit, dispatch, state }) {
        return new Promise((resolve, reject) => {
            if (state.accessToken) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${state.accessToken}`
            } else {
                return resolve(null)
            }
            axios.get('/user').then(response => {
                if (response.data.user) {
                    commit('setUser', response.data.user)
                    resolve(response.data.user)
                } else {
                    dispatch('destroyAccessToken')
                    dispatch('destroyUser')
                    resolve(null)
                }
            }).catch(() => {
                dispatch('destroyAccessToken')
                dispatch('destroyUser')
                resolve(null)
            })
        })
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
