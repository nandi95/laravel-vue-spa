import Vue from "vue";
import Card from "./Card";
import Button from "./Button";
import Checkbox from "./Checkbox";
import Error from "./Error";
import { AlertError, AlertSuccess } from "vform";

// Components that are registered globaly.
[Card, Button, Checkbox, Error, AlertError, AlertSuccess].forEach(Component => {
  Vue.component(Component.name, Component);
});
