
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
                    },
                    {
                        path:':slug/edit',
                        name:'articles-edit',
                        component: require('./views/articles/edit.vue')
                    }

                ]
            },
            {
                path: 'tags',
                component: Parent,
                children: [
                    {
                        path: '/',
                        name: 'tags',
                        component: require('./views/articles/list.vue')
                    }
                ]
            },
            {
                path: 'shares',
                component: Parent,
                children: [
                    {
                        path: '/',
                        name: 'shares',
                        component: require('./views/share/list.vue')
                    },
                    {
                        path: 'create',
                        name:'shares-create',
                        component:require('./views/share/create.vue')
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