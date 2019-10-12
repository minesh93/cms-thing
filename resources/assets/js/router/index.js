import VueRouter from 'vue-router';

let dashboard = () => import(/* webpackChunkName: "dashboard" */ '../pages/dashboard.vue');
let test = () => import(/* webpackChunkName: "test" */ '../pages/test.vue');

const router = new VueRouter({
    mode: 'history',
    base: '/admin/',
    routes: [
        { path: '/dashboard', component: dashboard },
        { path: '/test', component: test }
    ]
});

export default router;