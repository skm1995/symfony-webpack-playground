import { createApp } from 'vue';
import './styles/app.scss';

import App from './components/App.vue';
import router from './router';

const app = createApp(App);

app.use(router);
app.mount('#app');
