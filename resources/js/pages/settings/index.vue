<template>
  <div class="flex-around flex-col">
    <div class="w-full">
      <card :title="$t('settings')">
        <ul class="flex-start">
          <li v-for="tab in tabs" :key="tab.route">
            <router-link
              :to="{ name: tab.route }"
              class="nav-item"
              v-slot="{ navigate, href }"
              active-class="active"
              :style="$theme"
            >
              <a
                :href="href"
                @click="navigate"
                @mouseenter="$addHoverAccentColor"
                @mouseleave="$removeHoverAccentColor($event)"
              >
                {{ tab.name }}
              </a>
            </router-link>
          </li>
        </ul>
      </card>
    </div>
    <transition name="fade" mode="out-in">
      <router-view />
    </transition>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  computed: {
    tabs() {
      return [
        {
          name: this.$t("profile"),
          route: "settings.profile"
        },
        {
          name: this.$t("password"),
          route: "settings.password"
        },
        {
          name: this.$t("preferences"),
          route: "settings.preferences"
        }
      ];
    }
  }
};
</script>

<style lang="scss">
.nav-item {
  @apply rounded-full px-4 py-1 bg-gray-200 transition-all m-1;
  &:hover {
    @apply bg-gray-400 transition-all;
  }
}
</style>
