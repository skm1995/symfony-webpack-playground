<template>
  <div class="app">
    <header>
      <h1>Vue 3 + TypeScript + Symfony</h1>
      <nav>
        <RouterLink
          to="/"
          exact-active-class="active"
        >
          Home
        </RouterLink>
        <RouterLink
          to="/about"
          exact-active-class="active"
        >
          About
        </RouterLink>
      </nav>
    </header>
    
    <main>
      <RouterView />
    </main>
    
    <footer>
      <p>Built with Vue 3, TypeScript, and Webpack Encore</p>
    </footer>
  </div>
</template>

<script setup lang="ts">
// Root component - routing handled by Vue Router
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
    margin: 0 0 1rem;
  }
  
  nav {
    display: flex;
    justify-content: center;
    gap: 1rem;
    
    a {
      color: #35495e;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      transition: background-color 0.2s;
      
      &:hover {
        background-color: #f0f0f0;
      }
      
      &.active {
        background-color: #42b883;
        color: white;
      }
    }
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
