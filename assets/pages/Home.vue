<template>
  <div class="page home">
    <h1>Home Page</h1>
    <p>Welcome to the Vue 3 + Symfony SPA!</p>
    
    <div class="navigation">
      <h2>Navigation Examples</h2>
      <ul>
        <li>
          <RouterLink to="/about">
            Go to About (router-link)
          </RouterLink>
        </li>
        <li>
          <button @click="goToUser(1)">
            Go to User #1 (programmatic)
          </button>
        </li>
      </ul>
    </div>
    
    <Counter :initial-count="5" />
  </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';
import Counter from '../components/Counter.vue';

const router = useRouter();

const goToUser = (id: number): void => {
  router.push({ name: 'user-profile', params: { id: id.toString() } });
};
</script>

<style scoped lang="scss">
.home {
  .navigation {
    margin: 2rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    
    ul {
      list-style: none;
      padding: 0;
    }
    
    li {
      margin: 0.5rem 0;
    }
    
    a {
      color: #42b883;
      text-decoration: none;
      
      &:hover {
        text-decoration: underline;
      }
    }
    
    button {
      background: #42b883;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      cursor: pointer;
    }
  }
}
</style>
