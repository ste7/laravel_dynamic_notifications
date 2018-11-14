import axios from 'axios'


export const signUp = ({ commit }, data) => {
    return axios.post(`api/signup`, data).then(response => {
        return Promise.resolve()
    })
}

export const signIn = ({ commit }, data) => {
    return axios.post(`oauth/token`, data).then(response => {
        commit('setToken', response.data.access_token)

        return Promise.resolve()
    })
}

export const signOut = ({ commit }) => {
    commit('removeToken')
}

export const authenticate = ({ commit }) => {
    let token = localStorage.getItem('token')

    if (token) {
        commit('setHttp')

        axios.get('api/me').then(response => {
            commit('setUser', response.data.user)

            return Promise.resolve()
        }).catch(err => {
            commit('removeToken')

            return Promise.reject()
        })
    } else {
        return Promise.reject()
    }
}

export const updatePassword = ({ commit }, data) => {
    return axios.post(`api/password/update`, data).then(response => {
        commit('setUser', response.data)
    })
}

export const updateUser = ({ commit }, data) => {
    return axios.post(`api/user/update`, data).then(response => {
        commit('setUser', response.data)
    })
}

export const createPassword = ({ commit }, data) => {
    return axios.post(`api/password/create`, data)
}

export const resetPassword = ({ commit }, data) => {
    return axios.post(`api/password/reset`, data)
}