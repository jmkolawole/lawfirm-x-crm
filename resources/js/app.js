require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import vueResource from "vue-resource";
import Clients from "./components/Clients.vue";
//import About from "./components/About.vue";
import Add from "./components/Add.vue";
import ClientDetails from './components/ClientDetails.vue'
//import Edit from './components/Edit.vue'

Vue.use(vueResource);
Vue.use(VueRouter);

import moment from 'moment';
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY')
  }
});
const router = new VueRouter({
    mode: "history",
    base: __dirname,
    routes: [
        { path: "/", component: Clients },
        /*{ path: "/about", component: About },*/
        { path: "/add", component: Add },
        { path: "/client/:id", component: ClientDetails },
       /* { path: "/client/update/:id", component: Edit }*/
    ]
});

new Vue({
    router,
    template: `<div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Law Firm X</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" 
  data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
      <router-link to="/" class="nav-link"><b>Clients</b></router-link>
      </li> 
    </ul>

    <ul class="navbar-nav pull-right">
      <li class="nav-item pull-right">
      <router-link to="/add" class="nav-link"><b>Add Client</b></router-link>
      </li>
      
    </ul>
  </div>
</nav>
         
         <router-view></router-view>

        </div>
        `
}).$mount("#app");
