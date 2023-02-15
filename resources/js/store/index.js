import Vue from 'vue';
import Vuex from 'vuex'
import auth from "./modules/auth";
import users from "./modules/users";
import loading from "./modules/loading";
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        users,
        loading
    }
})
