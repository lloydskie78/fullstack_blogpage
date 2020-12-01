require('./bootstrap');
window.Vue = require('vue')

import common from './common'
Vue.mixin(common)

Vue.component('search', require('./components/search.vue').default)
Vue.component('comment', require('./components/comment.vue').default)
const app = new Vue({
    el: '#app', 
})