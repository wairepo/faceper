
import VueRouter from 'vue-router';

Vue.use(VueRouter)

let routes = [];

export default new VueRouter({
  routes,
  linkActiveClass: 'active',
  linkExactActiveClass: 'selected',
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
});
