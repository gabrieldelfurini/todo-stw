import { createRouter, createWebHistory } from "vue-router";

import LandingPage from '../components/marketing/LandingPage.vue';
import App from "../App.vue"
import About from "@/components/marketing/About.vue";
import Login from "@/components/auth/Login.vue";
import Logout from "@/components/auth/Logout.vue";
import Register from "@/components/auth/Register.vue";


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
        meta: {
          requiresAuth: true,
        }
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
      meta: {
        requiresVisitor: true,
      },
      props: true
    },
    {
      path: "/register",
      name: "register",
      component: Register,
      meta: {
        requiresVisitor: true,
      }
    },
    {
      path: "/logout",
      name: "logout",
      component: Logout,
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
