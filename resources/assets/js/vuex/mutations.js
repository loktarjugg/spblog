export default {
    LOADING_TOGGLE: (state, isLoading) => {
        state.isLoading = isLoading
    },
    SET_ARTICLES: (state, articles) => {
        state.articles = articles
    },
    SET_ARTICLE: (state, articles) => {
        state.article = articles
    },
    SET_TAGS: (state, tags) => {
        state.tags = tags
    },
    SET_TAG:(state , tag) => {
        state.tag.push({name:tag})
    },
    SET_SHARES:(state , shares) => {
        state.shares = shares;
    },
    SET_USER:(state , user) => {
        state.user = user;
    },
}
