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



router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!store.getters.loggedIn) {
        next({
          name: 'login',
        })
      } else {
        next()
      }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
      if (store.getters.loggedIn) {
        next({
          name: 'todo',
        })
      } else {
        next()
      }
    } else {
      next()
    }
  })



app.use(router)
app.use(store)
app.mount('#app')

// export default router;