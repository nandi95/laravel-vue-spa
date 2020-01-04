<template>
  <div>
    <div class="flex-end mt-3 links">
      <template v-if="authenticated">
        <router-link :to="{ name: 'home' }">
          {{ $t("home") }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t("login") }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t("register") }}
        </router-link>
      </template>
    </div>

    <div class="text-center text-6xl mt-64 select-none" :style="$themeText">
      {{ title }}
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  layout: "basic",
  metaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
    title: window.config.appName
  }),
  computed: mapGetters({
    authenticated: "auth/check"
  })
};
</script>
