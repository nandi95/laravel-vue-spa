<template>
  <div
    class="basic-layout d-flex align-items-center justify-content-center m-0 bg-white"
  >
    <transition name="page" mode="out-in">
      <slot>
        <router-view />
      </slot>
    </transition>
  </div>
</template>

<script>
export default {
  name: "BasicLayout"
};
</script>

<style lang="scss">
.basic-layout {
  color: #636b6f;
  font-weight: 100;
  position: relative;

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
