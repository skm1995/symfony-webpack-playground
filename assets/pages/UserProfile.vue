<template>
  <div class="page user-profile">
    <h1>User Profile</h1>
    
    <div
      v-if="loading"
      class="loading"
    >
      Loading...
    </div>
    
    <div
      v-else-if="error"
      class="error"
    >
      {{ error }}
    </div>
    
    <div
      v-else-if="user"
      class="profile-card"
    >
      <div class="avatar">
        {{ initials }}
      </div>
      <h2>{{ user.name }}</h2>
      <p class="email">
        {{ user.email }}
      </p>
      <span
        class="role"
        :class="`role-${user.role}`"
      >{{ user.role }}</span>
    </div>
    
    <p class="actions">
      <RouterLink
        to="/"
        class="back-link"
      >
        ← Back to Home
      </RouterLink>
    </p>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import type { User } from '../types';

interface Props {
  id: string;
}

const props = defineProps<Props>();

const user = ref<User | null>(null);
const loading = ref<boolean>(true);
const error = ref<string | null>(null);

const initials = computed<string>(() => {
  if (!user.value) return '';
  return user.value.name
    .split(' ')
    .map((part) => part[0])
    .join('')
    .toUpperCase()
    .slice(0, 2);
});

const fetchUser = async (): Promise<void> => {
  loading.value = true;
  error.value = null;
  
  try {
    const response = await fetch(`/api/users/${props.id}`);
    
    if (!response.ok) {
      throw new Error('User not found');
    }
    
    user.value = await response.json();
  } catch (err) {
    error.value = err instanceof Error ? err.message : 'Unknown error';
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchUser();
});
</script>

<style scoped lang="scss">
.user-profile {
  .loading,
  .error {
    padding: 2rem;
    text-align: center;
  }
  
  .error {
    color: #ff6b6b;
  }
  
  .profile-card {
    max-width: 400px;
    margin: 2rem auto;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
    
    .avatar {
      width: 80px;
      height: 80px;
      margin: 0 auto 1rem;
      border-radius: 50%;
      background: #42b883;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: bold;
    }
    
    h2 {
      margin: 0.5rem 0;
      color: #35495e;
    }
    
    .email {
      color: #666;
      margin: 0.5rem 0;
    }
    
    .role {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 12px;
      font-size: 0.75rem;
      text-transform: uppercase;
      font-weight: 500;
      
      &.role-admin {
        background: #ff6b6b;
        color: white;
      }
      
      &.role-user {
        background: #42b883;
        color: white;
      }
    }
  }
  
  .actions {
    text-align: center;
    margin-top: 2rem;
  }
  
  .back-link {
    color: #42b883;
    text-decoration: none;
    
    &:hover {
      text-decoration: underline;
    }
  }
}
</style>
