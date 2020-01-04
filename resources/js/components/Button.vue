<template>
  <button
    :type="nativeType"
    :disabled="loading"
    :class="{
      'btn-loading': loading
    }"
    :style="theme"
    class="btn btn-secondary"
    @click="$emit('click')"
    @mouseenter="addStyle"
    @mouseleave="removeStyle"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: "Button",
  props: {
    primary: { type: Boolean, default: false },
    nativeType: { type: String, default: "submit" },
    loading: { type: Boolean, default: false }
  },
  computed: {
    theme() {
      return this.primary ? this.$theme : {};
    }
  },
  methods: {
    addStyle(ev) {
      if (this.primary) {
        this.$addHoverAccentColor(ev);
      }
    },
    removeStyle(ev) {
      if (this.primary) {
        this.$removeHoverAccentColor(ev);
      }
    }
  }
};
</script>
