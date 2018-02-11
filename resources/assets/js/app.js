
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Multiselect from 'vue-multiselect'
import { quillEditor } from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
 
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('post-create-edit', require('./components/post-create-edit.vue'));

Vue.component('role-create-edit', require('./components/role-create-edit.vue'));

Vue.component('user-create-edit', require('./components/user-create-edit.vue'));

Vue.component('multiselect', Multiselect);
Vue.component('v-select', require('./components/select.vue'));

Vue.component('quill', quillEditor);

const app = new Vue({
    el: '#app'
});


console.log(app);