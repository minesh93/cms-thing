import VueRouter from 'vue-router';
import Claws from '../src/claws';

let dashboard = () => import(/* webpackChunkName: "dashboard" */ '../pages/dashboard.vue');
let test = () => import(/* webpackChunkName: "test" */ '../pages/test.vue');
let contentList = () => import(/* webpackChunkName: "content-list" */ '../pages/content-list.vue');

const router = new VueRouter({
    mode: 'history',
    base: Claws.base,
    routes: [
        { path: '/dashboard', component: dashboard },
        { path: '/test', component: test },
        { path: '/content/:type', component: contentList}
    ]
});

export default router;