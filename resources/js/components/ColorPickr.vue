<template>
  <div>
    <color-picker v-model="color"></color-picker>
  </div>
</template>

<script>
import ColorPicker from "vue-color-picker-wheel";
export default {
  name: "ColorPickr",
  components: {
    ColorPicker
  },
  created() {
    this.color = this.$themeColor;
  },
  data() {
    return {
      color: "#ffffff"
    };
  },
  watch: {
    color: function(newVal) {
      this.$store.dispatch("theme/updateTheme", newVal);
    }
  }
};
</script>
