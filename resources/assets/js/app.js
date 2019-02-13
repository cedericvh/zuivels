/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import App from './components/App.vue'
import router from './router'
import store from './store'


import vueSmoothScroll from 'vue2-smooth-scroll'


Vue.use(vueSmoothScroll)




require('./bootstrap')
require('./mixins')

import Tree from './components/admin/categories/Tree.vue'
import Alert from './components/partials/Alert.vue'


Vue.component('item', Tree)
Vue.component('alert', Alert)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export default new Vue({
    el: '#app',
    components: {App},
    router,    
    store,
    created() {
        let token = this.$store.getters.accessToken
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${token}`
        }

    }
})