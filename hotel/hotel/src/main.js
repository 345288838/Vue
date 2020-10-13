import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vconsole from 'vconsole'
import 'u-reset.css'
import store from "./store";
import Vant from 'vant';
import 'vant/lib/index.css';

Vue.use(Vant);

Vue.config.productionTip = false
new vconsole();
new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
