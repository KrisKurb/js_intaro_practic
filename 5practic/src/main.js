import Vue from 'vue'
import App from './App.vue'
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import VueRouter from 'vue-router'
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueLodash, { name: 'custom' , lodash: lodash })

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(VueAxios, axios)

import Home from './components/Home'
import Add from "./components/Add"
import Edit from "./components/Edit"
import Error from "./components/Error"
const router = new VueRouter({
  mode: 'history',
  routes:[
    { path: '/', component: Home, name: 'home' },
    { path: '/add', component: Add, name: 'add' },
    { path: '/:id/edit', component: Edit, name: 'edit'},
    { path: '*', component: Error, name: 'not-found' },
  ]
});
Vue.use(VueRouter)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
