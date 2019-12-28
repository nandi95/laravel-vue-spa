<template>
  <div class="row">
    <div class="col-md-3">
      <card :title="$t('settings')">
        <ul class="flex-start">
          <li v-for="tab in tabs" :key="tab.route">
            <router-link
              :to="{ name: tab.route }"
              class="nav-item"
              active-class="active"
            >
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  computed: {
    tabs() {
      return [
        {
          icon: "user",
          name: this.$t("profile"),
          route: "settings.profile"
        },
        {
          icon: "lock",
          name: this.$t("password"),
          route: "settings.password"
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
