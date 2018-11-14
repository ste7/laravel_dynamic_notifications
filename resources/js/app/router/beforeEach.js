import store from './../vuex'

export const beforeEach = ((to, from, next) => {
    store.dispatch('authenticate').then(response => {
        next()
    }).catch(err => {
        if (to.meta.auth) {
            if (to.path !== '/signin') {
                next('/signin')
            } else {
                next()
            }
        } else {
            next()
        }
    })
})

export default beforeEach