import Vue from 'vue'
import VueRouter from 'vue-router'
export default {
    getArticles: ({commit} , page ) => {
        return window.axios.get('/api/articles?include=tags', {
            params: {
                page: page
            }
        })
            .then(response => {
                commit('SET_ARTICLES', response.data)
            })
    },

    getArticle: ({commit} , slug ) => {
        return window.axios.get('/api/articles/' + slug)
            .then(response => {

                commit('SET_ARTICLE', response.data)
            })
    },

    postArticle: ({commit} , formData ) => {
        return window.axios.post('/api/articles' , formData)
            .then(response => {
                commit('LOADING_TOGGLE' , false);
                this.$router.push('articles');
                // Vue.$router.push('articles');

            }).catch(error => {
                console.log(error)
            })
    },

    getTags: ({commit} , groups ) => {
        return window.axios.get('/api/tags' ,{
            params:{
                groups: groups
            },
            responseType: 'json'
        })
            .then(response => {
                commit('SET_TAGS', response.data.data)
            })
            .catch(error =>{
                console.log(error)

            })
    },
    putTag:({commit} , value) => {
        commit('SET_TAG' , value);
    },
}
