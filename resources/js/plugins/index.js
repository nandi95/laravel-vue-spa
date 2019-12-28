import Vue from "vue";
import "./axios";
import VueToastify from "vue-toastify";
import vSelect from "vue-select";

Vue.use(VueToastify);
Vue.component("v-select", vSelect);
