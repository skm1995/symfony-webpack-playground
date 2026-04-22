<template>
  <div class="user-list">
    <h3>User List Component</h3>
    
    <div class="filters">
      <input 
        v-model="searchQuery" 
        type="text" 
        placeholder="Search users..."
        class="search-input"
      >
      <select
        v-model="roleFilter"
        class="role-filter"
      >
        <option value="">
          All Roles
        </option>
        <option value="admin">
          Admin
        </option>
        <option value="user">
          User
        </option>
      </select>
    </div>
    
    <div
      v-if="filteredUsers.length === 0"
      class="empty-state"
    >
      No users found.
    </div>
    
    <ul
      v-else
      class="users"
    >
      <li 
        v-for="user in filteredUsers" 
        :key="user.id"
        class="user-item"
        :class="{ 'is-selected': selectedUserId === user.id }"
        @click="selectUser(user)"
      >
        <div class="user-avatar">
          {{ getInitials(user.name) }}
        </div>
        <div class="user-info">
          <span class="user-name">{{ user.name }}</span>
          <span class="user-email">{{ user.email }}</span>
        </div>
        <span
          class="user-role"
          :class="`role-${user.role}`"
        >
          {{ user.role }}
        </span>
      </li>
    </ul>
    
    <div class="summary">
      Showing {{ filteredUsers.length }} of {{ users.length }} users
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import type { User, UserRole } from '../types';

interface Props {
  users: User[];
}

const props = defineProps<Props>();

const emit = defineEmits<{
  (e: 'select-user', user: User): void;
}>();

const searchQuery = ref<string>('');
const roleFilter = ref<UserRole | ''>('');
const selectedUserId = ref<number | null>(null);

const filteredUsers = computed<User[]>(() => {
  return props.users.filter((user) => {
    const matchesSearch = user.name
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase()) ||
      user.email.toLowerCase().includes(searchQuery.value.toLowerCase());
    
    const matchesRole = !roleFilter.value || user.role === roleFilter.value;
    
    return matchesSearch && matchesRole;
  });
});

const getInitials = (name: string): string => {
  return name
    .split(' ')
    .map(part => part[0])
    .join('')
    .toUpperCase()
    .slice(0, 2);
};

const selectUser = (user: User): void => {
  selectedUserId.value = user.id;
  emit('select-user', user);
};
</script>

<style scoped lang="scss">
.user-list {
  padding: 1.5rem;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  
  h3 {
    margin-top: 0;
    color: #35495e;
  }
  
  .filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    
    .search-input,
    .role-filter {
      padding: 0.5rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }
    
    .search-input {
      flex: 1;
    }
  }
  
  .empty-state {
    text-align: center;
    padding: 2rem;
    color: #666;
  }
  
  .users {
    list-style: none;
    padding: 0;
    margin: 0;
    
    .user-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      transition: background-color 0.2s;
      
      &:hover {
        background-color: #f8f9fa;
      }
      
      &.is-selected {
        background-color: #e8f5e9;
        border-left: 3px solid #42b883;
      }
      
      &:last-child {
        border-bottom: none;
      }
      
      .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #42b883;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
      }
      
      .user-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        
        .user-name {
          font-weight: 500;
          color: #35495e;
        }
        
        .user-email {
          font-size: 0.85rem;
          color: #666;
        }
      }
      
      .user-role {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 500;
        
        &.role-admin {
          background-color: #ff6b6b;
          color: white;
        }
        
        &.role-user {
          background-color: #42b883;
          color: white;
        }
      }
    }
  }
  
  .summary {
    margin-top: 1rem;
    text-align: right;
    font-size: 0.85rem;
    color: #666;
  }
}
</style>
