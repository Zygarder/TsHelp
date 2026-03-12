import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue'; // We will create this file next
import router from './router.js';


createApp(App).use(router).mount('#app');