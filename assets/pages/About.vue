<template>
  <div class="page about">
    <h1>About Page</h1>
    <p>This is a sample Vue 3 + TypeScript + Symfony application.</p>
    
    <div class="features">
      <h2>Features</h2>
      <ul>
        <li>Vue 3 with Composition API</li>
        <li>TypeScript support</li>
        <li>Vue Router for SPA navigation</li>
        <li>Symfony backend</li>
        <li>Webpack Encore asset compilation</li>
      </ul>
    </div>
    
    <p>
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
// No script needed for this static page
</script>

<style scoped lang="scss">
.about {
  .features {
    margin: 2rem 0;
    
    ul {
      list-style: disc;
      padding-left: 1.5rem;
    }
    
    li {
      margin: 0.5rem 0;
    }
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
