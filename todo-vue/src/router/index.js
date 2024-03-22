import { createRouter, createWebHistory } from "vue-router";

import LandingPage from '../components/marketing/LandingPage.vue';
// import EditarIngrediente from "../views/Ingredientes/Editar.vue";


const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
        path: "/",
        name: "landing-page",
        component: LandingPage,
    },
    {
        path: "/todos",
        name: "landing-page",
        component: LandingPage,
    },
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
