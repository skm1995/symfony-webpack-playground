<template>
  <div class="hello-world">
    <h2>{{ msg }}</h2>
    <p>
      <button
        class="btn-primary"
        @click="updateMessage"
      >
        Click to update message
      </button>
    </p>
    <p class="hint">
      Edit <code>components/HelloWorld.vue</code> to see hot reload in action.
    </p>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

interface Props {
  msg: string;
}

defineProps<Props>();

const emit = defineEmits<{
  (e: 'update-message', message: string): void;
}>();

const clickCount = ref<number>(0);

const updateMessage = (): void => {
  clickCount.value++;
  emit('update-message', `Message clicked ${clickCount.value} times`);
};
</script>

<style scoped lang="scss">
.hello-world {
  padding: 1.5rem;
  background: #f8f9fa;
  border-radius: 8px;
  
  h2 {
    color: #35495e;
    margin-top: 0;
  }
  
  .btn-primary {
    background-color: #42b883;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
    
    &:hover {
      background-color: #369870;
    }
  }
  
  .hint {
    color: #666;
    font-size: 0.9rem;
    
    code {
      background-color: #eee;
      padding: 0.2rem 0.4rem;
      border-radius: 3px;
      color: #d63200;
    }
  }
}
</style>
