<template>
  <div class="main-layout bg-gray-100 dark:bg-gray-900" style="height: 100vh">
    <Navbar />

    <div class="container mt-4">
      <transition name="page" mode="out-in">
        <slot>
          <router-view />
        </slot>
      </transition>
    </div>
  </div>
</template>

<script>
import Navbar from "~/components/Navbar";

export default {
  name: "MainLayout",
  components: {
    Navbar
  }
};
</script>
