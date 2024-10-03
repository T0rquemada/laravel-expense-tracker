import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/Home.vue"),
    },
    {
        path: "/sign-in-view",
        component: () => import("./Pages/SignForm.vue"),
        props: { title: 'Sign in'},
    },
    {
        path: "/sign-up-view",
        component: () => import("./Pages/SignForm.vue"),
        props: { title: 'Sign up'},
    },
];

export default createRouter({
    history: createWebHistory(),
    routes: routes
});
