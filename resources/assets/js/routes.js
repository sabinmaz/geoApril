/**
 * Created by sabin on 4/7/2017.
 */

import VueRouter from 'vue-router';
import _ from 'lodash';
console.log(_.last(window.location.pathname.split( '/' )));
let routes=[
    {
        name: 'home',
        path: '/',
       component: require('./components/frontend/Home.vue')
    },
    {
        name: 'country',
        path: '/:country',
        component: require('./components/frontend/Country.vue')
},
    {
        name: 'province',
        path: '/:country/:province',
        component: require('./components/frontend/Province.vue')
    },
    {
        name: 'commune',
        path: '/:country/:province/:commune',
        component: require('./components/frontend/Commune.vue')
    },
    {
        name: 'zone',
        path: '/:country/:province/:commune/:zone',
        component: require('./components/frontend/Zone.vue')
    },
    {
        name: 'colline',
        path: '/:country/:province/:commune/:zone/:colline',
        component: require('./components/frontend/Colline.vue')
    },
];
export default new VueRouter({
   routes,
    linkActiveClass: 'is-active'
});