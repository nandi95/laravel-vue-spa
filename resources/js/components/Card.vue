<template functional>
  <div
    class="shadow border rounded p-4 mb-3 dark:bg-gray-800 dark:border-gray-800"
  >
    <div v-if="props.title" class="font-bold mb-2 text-body">
      {{ props.title }}
    </div>
    <div class="card-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    title: { type: String, default: null }
  }
};
</script>
