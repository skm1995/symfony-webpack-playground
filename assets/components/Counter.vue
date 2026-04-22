<template>
  <div class="counter">
    <h3>Counter Component</h3>
    <div class="counter-display">
      <span class="count">{{ count }}</span>
      <span class="label">clicks</span>
    </div>
    <div class="buttons">
      <button
        class="btn-decrement"
        :disabled="count <= min"
        @click="decrement"
      >
        -
      </button>
      <button
        class="btn-reset"
        @click="reset"
      >
        Reset
      </button>
      <button
        class="btn-increment"
        :disabled="count >= max"
        @click="increment"
      >
        +
      </button>
    </div>
    <div
      v-if="count === max"
      class="alert alert-warning"
    >
      Maximum value reached!
    </div>
    <div
      v-if="count === min"
      class="alert alert-info"
    >
      Minimum value reached!
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

interface Props {
  initialCount?: number;
  min?: number;
  max?: number;
  step?: number;
}

const props = withDefaults(defineProps<Props>(), {
  initialCount: 0,
  min: 0,
  max: 100,
  step: 1,
});

const emit = defineEmits<{
  (e: 'change', value: number): void;
  (e: 'limit-reached', limit: 'min' | 'max'): void;
}>();

const count = ref<number>(props.initialCount);

const increment = (): void => {
  if (count.value + props.step <= props.max) {
    count.value += props.step;
  }
};

const decrement = (): void => {
  if (count.value - props.step >= props.min) {
    count.value -= props.step;
  }
};

const reset = (): void => {
  count.value = props.initialCount;
};

watch(count, (newValue) => {
  emit('change', newValue);
  
  if (newValue === props.max) {
    emit('limit-reached', 'max');
  } else if (newValue === props.min) {
    emit('limit-reached', 'min');
  }
});
</script>

<style scoped lang="scss">
.counter {
  padding: 1.5rem;
  background: #fff;
  border: 2px solid #42b883;
  border-radius: 8px;
  text-align: center;
  
  h3 {
    margin-top: 0;
    color: #35495e;
  }
  
  .counter-display {
    margin: 1.5rem 0;
    
    .count {
      font-size: 3rem;
      font-weight: bold;
      color: #42b883;
    }
    
    .label {
      color: #666;
      margin-left: 0.5rem;
    }
  }
  
  .buttons {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    
    button {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
      transition: opacity 0.2s;
      
      &:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }
    }
    
    .btn-decrement {
      background-color: #ff6b6b;
      color: white;
    }
    
    .btn-reset {
      background-color: #35495e;
      color: white;
    }
    
    .btn-increment {
      background-color: #42b883;
      color: white;
    }
  }
  
  .alert {
    margin-top: 1rem;
    padding: 0.75rem;
    border-radius: 4px;
    font-size: 0.9rem;
    
    &.alert-warning {
      background-color: #fff3cd;
      color: #856404;
    }
    
    &.alert-info {
      background-color: #d1ecf1;
      color: #0c5460;
    }
  }
}
</style>
