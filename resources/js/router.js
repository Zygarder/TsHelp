import { createRouter, createWebHistory } from "vue-router";
import TSHelpLogin from "./components/TSHelpLogin.vue";
import TSHelpRegister from "./components/TSHelpRegister.vue";
import TSHelpForgotPassword from "./components/TSHelpForgotPassword.vue";
import Dashboard from './components/user/Dashboard.vue';
import ReportIssue from "./components/user/ReportIssue.vue";
import TicketSuccess from "./components/user/TicketSuccess.vue";
import SendSuggestion from "./components/user/SendSuggestion.vue";

const routes = [
    { path: "/", name: "Login", component: TSHelpLogin },
    { path: "/register", name: "Register", component: TSHelpRegister },
    {
        path: "/forgot-password",
        name: "ForgotPassword",
        component: TSHelpForgotPassword,
    },
    { 
        path: '/dashboard', 
        name: 'Dashboard', 
        component: Dashboard 
      },
      { 
        path: '/report', 
        name: 'Report', 
        component: ReportIssue 
      },
      { 
        path: '/success', 
        name: 'Success', 
        component: TicketSuccess 
      },
      { 
        path: '/suggest', 
        name: 'Suggest', 
        component: SendSuggestion 
      }
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
