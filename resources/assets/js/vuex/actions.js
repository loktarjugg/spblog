import Vue from 'vue'
import VueRouter from 'vue-router'
export default {
    getArticles: ({commit}, page) => {
        return window.axios.get('/api/articles?include=tags', {
            params: {
                page: page || 1
            }
        })
            .then(response => {
                commit('SET_ARTICLES', response.data)
            })
    },

    getArticle: ({commit}, slug) => {
        return window.axios.get('/api/articles/' + slug, {
            params: {
                include: 'tags'
            }
        })
            .then(response => {
                commit('SET_ARTICLE', response.data.data)
            })
    },

    postArticle: ({commit}, formData) => {
        return window.axios.post('/api/articles', formData)
            .then(response => {
                commit('LOADING_TOGGLE', false);
                this.$router.push('articles');
                // Vue.$router.push('articles');

            }).catch(error => {
                console.log(error)
            })
    },
    getTags: ({commit}, groups) => {
        return window.axios.get('/api/tags', {
            params: {
                groups: groups
            },
            responseType: 'json'
        })
            .then(response => {
                commit('SET_TAGS', response.data.data)
            })
            .catch(error => {

            })
    },
    putTag: ({commit}, value) => {
        commit('SET_TAG', value);
    },
    getShares: ({commit}, page) => {
        return window.axios.get('/api/shares', {
            params: {
                page: page || 1
            }
        })
            .then(response => {
                commit('SET_SHARES', response.data)
            })
    },

}
