import { createRouter, createWebHistory } from "vue-router";
import TSHelpLogin from "./components/TSHelpLogin.vue";
import TSHelpRegister from "./components/TSHelpRegister.vue";
import TSHelpForgotPassword from "./components/TSHelpForgotPassword.vue";

const routes = [
    { path: "/", name: "Login", component: TSHelpLogin },
    { path: "/register", name: "Register", component: TSHelpRegister },
    {
        path: "/forgot-password",
        name: "ForgotPassword",
        component: TSHelpForgotPassword,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
