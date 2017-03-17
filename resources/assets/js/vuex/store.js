import Vue from 'vue';
import Vuex from 'vuex';
import actions    from './actions'
import mutations  from './mutations'
import getters    from './getters'
import { Loading }  from 'element-ui'
Vue.use(Vuex);


export default new Vuex.Store({
    state:{
        isLoading:false,
        articles: [],
        article: {},
        tags:[],
        tag:[]
    },
    // getters,
    mutations,
    actions,
    watch:{
        isLoading :function (loading) {
            Loading.service({fullscreen: true})
        }
    }
});