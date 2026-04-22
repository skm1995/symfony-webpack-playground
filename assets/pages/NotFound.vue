<template>
  <div class="page not-found">
    <h1>404 - Page Not Found</h1>
    <p>The page you're looking for doesn't exist.</p>
    
    <RouterLink
      to="/"
      class="home-link"
    >
      Go to Home
    </RouterLink>
  </div>
</template>

<script setup lang="ts">
// No script needed
</script>

<style scoped lang="scss">
.not-found {
  text-align: center;
  padding: 3rem;
  
  h1 {
    color: #ff6b6b;
    font-size: 3rem;
    margin-bottom: 1rem;
  }
  
  p {
    color: #666;
    margin-bottom: 2rem;
  }
  
  .home-link {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: #42b883;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    
    &:hover {
      background: #369870;
    }
  }
}
</style>
