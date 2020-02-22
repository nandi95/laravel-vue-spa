<template>
  <div class="pass-field-wrap">
    <ShowPasswordButton
      :pass-field="nameId"
      class="show-pass-btn"
      :color="iconColor"
      @click="type = $event"
    />
    <input
      :id="nameId"
      :type="type"
      :class="customClass"
      :name="nameId"
      class="pass-field"
      :required="isRequired"
      @input="$emit('input', $event.target.value)"
    />
  </div>
</template>

<script>
import ShowPasswordButton from "./ShowPasswordButton";
export default {
  name: "PasswordField",
  props: {
    nameId: { type: String, required: true },
    customClass: { type: String, required: false },
    isRequired: { type: Boolean, default: true },
    iconColor: { type: String, required: false }
  },
  components: {
    ShowPasswordButton
  },
  data() {
    return {
      type: "password"
    };
  }
};
</script>
<style scoped lang="scss">
.pass-field-wrap {
  position: relative;
  display: block;
}
.pass-field {
  text-indent: 20px;
}
.show-pass-btn {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
}
</style>
