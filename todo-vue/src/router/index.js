import { createRouter, createWebHistory } from "vue-router";

import LandingPage from '../components/marketing/LandingPage.vue';
import App from "../App.vue"
import About from "@/components/marketing/About.vue";
import Login from "@/components/auth/Login.vue";
import Register from "@/components/auth/Register.vue";
import TestTodosVariable from "@/components/marketing/TestTodosVariable.vue";


const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
        path: "/",
        name: "home",
        component: LandingPage,
    },
    {
        path: "/todo",
        name: "todo",
        component: App,
    },
    {
      path: "/about",
      name: "about",
      component: About,
    },
    {
      path: "/login",
      name: "login",
      component: Login,
    },
    {
      path: "/register",
      name: "register",
      component: Register,
    },
    {
      path: "/todos/:id",
      name: "todos",
      component: TestTodosVariable,
    }
    
  ],
});

export default router;
 

// const router = createRouter({
//     history: createWebHistory(),
//     routes: [
//       {
//         path: "/",
//         name: "layout-page",
//         component: LandingPage,
//       },
//       {
//         path: '/todos',
//         name: "App",
//         component: App,
//       },
      
//     ]
//   });
