<template>
  <card :title="$t('preferences')" class="mx-auto w-full md:w-1/2">
    <ColorPickr />
  </card>
</template>

<script>
import ColorPickr from "../../components/ColorPickr";
export default {
  components: { ColorPickr },
  scrollToTop: false,
  metaInfo() {
    return { title: this.$t("preferences") };
  }
};
</script>
