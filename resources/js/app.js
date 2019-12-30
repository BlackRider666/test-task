require('./bootstrap');
import Vue from "vue";
import store from './store/index.js';
import VueRouter from "vue-router";
import App from "./App";
import routes from "./routes.js";
const router = new VueRouter({
  routes,
  mode: 'history'
});
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // этот путь требует авторизации, проверяем залогинен ли
    // пользователь, и если нет, перенаправляем на страницу логина
    if (!store.getters.loggedIn) {
      next({
        name: 'login'
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    // этот путь требует авторизации, проверяем залогинен ли
    // пользователь, и если нет, перенаправляем на страницу логина
    if (store.getters.loggedIn) {
      next({
        name: 'home'
      })
    } else {
      next()
    }
  }else if (to.matched.some(record => record.meta.requiresAdmin)) {
    // этот путь требует авторизации, проверяем залогинен ли
    // пользователь, и если нет, перенаправляем на страницу логина
    if (!store.getters.userIsAdmin) {
      next({
        name: 'not_admin'
      })
    } else {
      next()
    }
  }else {
    next() // всегда так или иначе нужно вызвать next()!
  }
})
Vue.use(VueRouter);
new Vue({
	store,
	router,
	render: h => h(App)
}).$mount("#app");
