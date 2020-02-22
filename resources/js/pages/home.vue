<template>
  <card :title="$t('home')">
    <span class="text-body">
      {{ $t("you_are_logged_in") }}
    </span>
<!--    <Button @click="click">Test websocket!</Button>-->
<!--    <span-->
<!--      class="rounded p-2 text-6xl bg-red-600 text-white"-->
<!--      v-if="websocketWorks"-->
<!--      >It worked!</span-->
<!--    >-->
  </card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("home") };
  },
  computed: mapGetters({
    user: "auth/user"
  }),
  data() {
    return {
      websocketWorks: false
    };
  }
};
</script>
