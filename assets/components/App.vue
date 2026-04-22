<template>
  <div class="app">
    <header>
      <h1>Vue 3 + TypeScript + Symfony</h1>
    </header>
    
    <main>
      <HelloWorld 
        msg="Welcome to your Vue 3 + TypeScript app!" 
        @update-message="handleMessageUpdate"
      />
      
      <Counter :initial-count="5" />
      
      <UserList
        :users="users"
        @select-user="handleUserSelect"
      />
    </main>
    
    <footer>
      <p>Built with Vue 3, TypeScript, and Webpack Encore</p>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import HelloWorld from './HelloWorld.vue';
import Counter from './Counter.vue';
import UserList from './UserList.vue';
import type { User } from '../types';

const users = ref<User[]>([
  { id: 1, name: 'John Doe', email: 'john@example.com', role: 'admin' },
  { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'user' },
  { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'user' },
]);

const handleMessageUpdate = (newMessage: string): void => {
  console.log('Message updated:', newMessage);
};

const handleUserSelect = (user: User): void => {
  console.log('Selected user:', user.name);
};
</script>

<style scoped lang="scss">
.app {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
}

header {
  text-align: center;
  margin-bottom: 2rem;
  
  h1 {
    color: #42b883;
    font-size: 2.5rem;
    margin: 0;
  }
}

main {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

footer {
  margin-top: 3rem;
  text-align: center;
  color: #666;
  font-size: 0.9rem;
}
</style>
