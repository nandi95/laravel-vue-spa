<template>
  <label class="toggle">
    <input
      type="checkbox"
      :name="name"
      class="checkbox-input"
      @click="toggle"
      :checked="checked"
    />
    <span class="slider" :style="styles" />
  </label>
</template>

<script>
export default {
  name: "Toggle",
  props: {
    name: { type: String, required: true },
    checked: { type: Boolean, default: false },
    defaultColor: { type: String, default: "#c8c8c8" },
    checkedColor: { type: String }
  },
  data() {
    return {
      isChecked: false
    };
  },
  mounted() {
    this.isChecked = this.checked;
  },
  methods: {
    toggle(ev) {
      this.$emit("click", ev.target.checked);
      this.isChecked = !this.isChecked;
    }
  },
  computed: {
    styles() {
      let obj = {};
      if (this.isChecked) {
        obj["background-color"] = this.checkedColor
          ? this.checkedColor
          : this.$themeColor;
      } else {
        obj["background-color"] = this.defaultColor;
      }
      return obj;
    }
  }
};
</script>

<style lang="css">
/* Hide default input */
.toggle input {
  display: none;
}

/* The container and background */
.toggle {
  position: relative;
  display: inline-block;
  width: 35px;
  height: 19px;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 30px;
  transition: all 0.4s;
}

/* The sliding button */
.slider:before {
  position: absolute;
  content: "";
  width: 15px;
  height: 15px;
  left: 2px;
  top: 2px;
  background-color: #eee;
  border-radius: 15px;
  transition: all 0.4s;
}

input:checked + .slider:before {
  transform: translateX(16px);
}
</style>
