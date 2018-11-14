export const setToken = (state, token) => {
    if (! state.user.signedIn) {
        localStorage.setItem('token', token)
        state.user.signedIn = true
    }
}

export const removeToken = (state) => {
    localStorage.removeItem('token')
    state.user.signedIn = false
}

export const setHttp = (state) => {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
}

export const setUser = (state, user) => {
    state.user.data = user
    state.user.signedIn = true
}