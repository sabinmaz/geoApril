/**
 * Created by sabin on 4/7/2017.
 */

import VueRouter from 'vue-router';

let routes=[
    {
       path: '/',
       component: require('./components/Home.vue')
    }
];
export default new VueRouter({
   routes,
    linkActiveClass: 'is-active'
});