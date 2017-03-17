require('./bootstrap');
Vue.component('articles' ,require('./components/articles.vue'));

import App from './App.vue';
import ElementUI from 'element-ui'
import VueRouter from 'vue-router'
import 'element-ui/lib/theme-default/index.css'
import routes from './routes';
import store from './vuex/store';
import VueProgressBar from 'vue-progressbar';

Vue.use(ElementUI);
Vue.use(VueRouter);

Vue.use(VueProgressBar, {
    color: '#00a626',
    failedColor: 'red',
    height: '2px'
})

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    saveScrollPosition: true,
    root: '/admin',
    routes: routes
});


const app = new Vue(Vue.util.extend({ router,store},App)).$mount('#app');
