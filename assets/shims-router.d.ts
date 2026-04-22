import 'vue-router';

// Type declarations for Vue Router

declare module '*.vue' {
  import type { DefineComponent } from 'vue';
  const component: DefineComponent<object, object, unknown>;
  export default component;
}

declare module 'vue-router' {
  interface RouteMeta {
    // Add custom meta fields here
    requiresAuth?: boolean;
  }
}
