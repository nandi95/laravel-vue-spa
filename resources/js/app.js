import Vue from "vue";
import store from "~/store";
import router from "~/router";
import i18n from "~/plugins/i18n";
import App from "~/components/App";

import "~/plugins";
import "~/components";
import "~/mixins";
import "~/directives";

Vue.config.productionTip = false;

window.EventBus = new Vue({
  i18n,
  store,
  router,
  ...App
});
