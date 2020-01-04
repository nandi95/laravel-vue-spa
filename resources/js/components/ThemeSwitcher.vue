<template>
  <div class="flex-between">
    <Sun class="icon-big text-gray-400" />
    <Toggle
      checked-color="#445379"
      class="mx-2 my-auto"
      name="theme-switcher"
      @click="toggleTheme"
      :checked="$store.getters['theme/darkMode']"
    />
    <Moon class="icon-big text-gray-700" />
  </div>
</template>

<script>
import Sun from "icons/WhiteBalanceSunny";
import Moon from "icons/WeatherNight";
import Toggle from "./Toggle";
export default {
  name: "ThemeSwitcher",
  components: { Toggle, Sun, Moon },
  mounted() {
    let html = document.getElementsByTagName("html")[0];
    if (this.$store.getters["theme/darkMode"]) {
      html.classList.add("mode-dark");
    } else {
      html.classList.remove("mode-dark");
    }
  },
  methods: {
    toggleTheme(value) {
      document.getElementsByTagName("html")[0].classList.toggle("mode-dark");
      this.$store.dispatch("theme/updateDarkMode", value);
    }
  }
};
</script>
