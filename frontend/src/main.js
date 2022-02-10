import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router";
import router from "./routes";
import { initializeApp } from 'firebase/app';
// import { conf } from './conf.js';
Vue.use(VueRouter);

Vue.config.productionTip = false;
const config = {
  apiKey: "AIzaSyDkp9Y5DaS60xQ1N9R2lemZXaLSh_dtBVQ",
  authDomain: "blog-demo-v2.firebaseapp.com",
};
initializeApp(config);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
