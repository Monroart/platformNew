export default {
    namespaced: true,
    state:{
        isLoading: false
    },
    mutations: {
        SET_LOADING(state, value){
            state.isLoading = value
        }
    },
    actions: {
        startLoading({commit}){
            console.log(1111)
            commit('SET_LOADING', true)
        },
        endLoading({commit}){
            commit('SET_LOADING',false)
        },
    }
}
