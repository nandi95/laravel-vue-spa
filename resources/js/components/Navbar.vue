<template>
  <nav class="shadow py-3">
    <div class="container flex-between">
      <div class="flex-between">
        <router-link
          :to="{ name: user ? 'home' : 'welcome' }"
          class="mr-3 text-xl text-gray-700"
          v-text="appName"
        />
        <LocaleDropdown />
      </div>
      <div>
        <ul class="flex-between">
          <!-- Authenticated -->
          <li v-if="user" class="relative">
            <a
              role="button"
              class="flex-between"
              aria-haspopup="true"
              aria-expanded="false"
              @click.prevent="menuOpen = true"
            >
              <img
                :src="user.photoUrl"
                class="rounded-circle profile-photo mr-2"
              />
              <span>{{ user.firstName + " " + user.lastName }}</span>
            </a>
            <transition name="fade">
              <div
                v-if="menuOpen"
                v-click-outside="()=>{ menuOpen = false }"
                class="flex-around dropdown absolute"
              >
                <router-link
                  :to="{ name: 'settings.profile' }"
                  class="dropdown-item"
                >
                  {{ $t("settings") }}
                </router-link>
                <a href="#" class="dropdown-item" @click.prevent="logout">
                  {{ $t("logout") }}
                </a>
              </div>
            </transition>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="mx-1">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("login") }}
              </router-link>
            </li>
            <li class="mx-1">
              <router-link
                :to="{ name: 'register' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("register") }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";
// import clickOutside from "~/directives/click-outside";
import { directive as clickOutside } from "vue-on-click-outside";

export default {
  components: {
    LocaleDropdown
  },
  directives: {
    clickOutside
  },
  data() {
    return {
      menuOpen: false,
      appName: window.config.appName
    };
  },
  computed: mapGetters({
    user: "auth/user"
  }),
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    }
  }
};
</script>

<style scoped lang="scss">
.profile-photo {
  width: 2rem;
  height: 2rem;
  @apply rounded-full;
}
.dropdown {
  @apply transition-all flex-col border shadow bg-white rounded;
  & > .dropdown-item {
    @apply w-full py-1 px-4 text-center;
    &:hover {
      @apply transition-all bg-gray-200;
    }
  }
}
.nav-link {
  @apply text-gray-600 transition-all;
  &:hover {
    @apply text-gray-500 transition-all;
  }
}
</style>
