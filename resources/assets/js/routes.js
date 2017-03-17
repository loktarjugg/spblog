
import Parent from './views/layouts/parent.vue'
export default [
    {
        path: '/admin',
        component: Parent,
        children:[
            {
                path:'/',
                component: require('./views/dashboard.vue'),
            },
            {
                path: 'articles',
                component: Parent,
                children: [
                    {
                        path: '/',
                        name: 'articles',
                        component: require('./views/articles/list.vue')
                    },
                    {
                        path: 'create',
                        name:'articles-create',
                        component : require('./views/articles/create.vue')
                    }

                ]
            },
            {
                path: '*',
                redirect: '/admin'
            }
        ]
    }

]