<template>
  <div :class="classes">
    <div class="flex items-center justify-center">
      <span v-if="type === 'success'" class="text-green-500 mr-2">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="check-circle w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      <span v-else-if="type === 'error'" class="text-red-500 mr-2">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="exclamation-circle w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4M12 17.5c0 .276-.224.5-.5.5s-.5-.224-.5-.5.224-.5.5-.5.5.224.5.5zm0-12c.552 0 1 .448 1 1v10c0 .552-.448 1-1 1s-1-.448-1-1V6c0-.552.448-1 1-1z"></path>
        </svg>
      </span>
      <span class="text-gray-700">{{ message }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    type: String,
    message: String,
    visible: Boolean,
  },
  computed: {
    classes() {
      return {
        'bg-green-100 border-green-400 text-green-700': this.type === 'success',
        'bg-red-100 border-red-400 text-red-700': this.type === 'error',
        'border-l-4': true,
        'p-4': true,
        'mt-4': true,
        'opacity-100': this.visible,
        'opacity-0': !this.visible,
      };
    },
  },
};
</script>