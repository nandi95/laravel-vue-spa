<template>
  <eye-icon
    @mousedown="showPass"
    @mouseup="hidePass"
    id="showPass"
    :class="color"
    class="z-50"
  />
</template>

<script>
import EyeIcon from "icons/Eye";
export default {
  name: "ShowPassword",
  components: { EyeIcon },
  props: {
    color: { type: String, required: false }
  },
  mounted() {
    document.getElementById("showPass").addEventListener("touchstart", () => {
      this.showPass();
    });
    document.getElementById("showPass").addEventListener("touchend", () => {
      this.hidePass();
    });
  },
  methods: {
    showPass() {
      this.$emit("click", "text");
    },
    hidePass() {
      this.$emit("click", "password");
    }
  }
};
</script>
