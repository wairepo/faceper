/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// const PAGE_ACCESS_TOKEN = process.env.PAGE_ACCESS_TOKEN;

import './bootstrap.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// import './sass/app.scss'

import router from './routes.js'
window.router = router

import store from './store.js'
window.store = store

// import Vue from 'vue'
import Vuetify from 'vuetify'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

require('./components.js');

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

// import sidebarJS from '@/js/sidebar.js'
// import Routes from '@/js/routes.js'



// window.Routes = Routes

import App from '@/js/views/App'

Vue.use(Vuetify)
// Vue.use(sidebarJS)

// Vue.mixin({
// 	methods: {
// 		makeToast(title, message, variant) {
// 			// this.toastCount++
// 			this.$bvToast.toast(message, {
// 				title: title,
// 				autoHideDelay: 5000,
// 				variant: variant
// 			})
// 		}
// 	}
// })

const app = new Vue({
    el: '#app',
    store,
    router,
    vuetify : new Vuetify(),
    render: h => h(App)
});

require('./routes/routes.js');

// export default app;

// router.beforeEach((to, from, next) => {
  // app.$unsaved.clear()
  // next()
// })


/**
 * Route after change event
 *
 * Update sidebar "selected" class by detecting route path
 * by @frost
 */
// router.afterEach((to, from, next) => {
//   var path = to.path.split('/');
//   path = path.filter(entry => /\S/.test(entry))[0];
  // store.state.sidebar_selected = path;
  // window.Intercom('update');
  // store.commit('update') // Vuex update global store.state and update intercom
  // tracking.pageview(to.path);
// })

// window.Vue = require('vue');

// console.log(1231231)

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });

setInterval(function(){
  store.commit('update')
  // Vue.config.lang = store.state.user.locale
}, 30000)
