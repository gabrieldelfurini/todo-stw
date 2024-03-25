import { createApp } from 'vue'
// import App from './App.vue'
import Master from './components/layouts/Master.vue'
import mitt from 'mitt';
import store from './store/store.js';
import router from './router/index.js';


const emitter = mitt();

const app = createApp(Master);

export const eventBus = createApp(Master)

app.config.globalProperties.emitter = emitter;

app.use(router)
app.use(store)
app.mount('#app')

// export default router;