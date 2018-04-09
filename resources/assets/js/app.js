
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Multiselect from 'vue-multiselect';

import ClawsUploader from './plugins/uploader';
import ClawsNotifications from './plugins/notifications';

import { quillEditor } from 'vue-quill-editor';

Vue.use(ClawsUploader);
Vue.use(ClawsNotifications);
 
Vue.component('settings-edit', require('./components/settings-edit.vue'));
Vue.component('post-create-edit', require('./components/post-create-edit.vue'));
Vue.component('role-create-edit', require('./components/role-create-edit.vue'));
Vue.component('user-create-edit', require('./components/user-create-edit.vue'));

Vue.component('multiselect', Multiselect);
Vue.component('quill', quillEditor);

Vue.component('v-select', require('./components/select.vue'));
Vue.component('v-editor', require('./components/editor.vue'));

Vue.component('v-notification', require('./components/notification.vue'));

Vue.component('v-uploader', require('./components/media-uploader.vue'));
Vue.component('v-media', require('./components/media-item.vue'));

const app = new Vue({
    el: '#app'
});

