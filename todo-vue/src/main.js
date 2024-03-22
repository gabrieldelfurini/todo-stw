import { createApp } from 'vue'
import App from './App.vue'
import mitt from 'mitt';
import store from './store/store.js';

const emitter = mitt();

const app = createApp(App);
export const eventBus = createApp(App)
app.config.globalProperties.emitter = emitter;
app.use(store)
app.mount('#app')
