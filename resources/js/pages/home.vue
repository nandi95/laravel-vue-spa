<template>
  <card :title="$t('home')">
    <span class="text-body">
      {{ $t("you_are_logged_in") }}
    </span>
  </card>
</template>

<script>
export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
