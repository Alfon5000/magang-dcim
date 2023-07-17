import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: () => import("../pages/Dashboard.vue"),
    },
    {
        path: "/visitors",
        name: "visitors.index",
        component: () => import("../pages/Visitors/Index.vue"),
    },
    {
        path: "/visitors/create",
        name: "visitors.create",
        component: () => import("../pages/Visitors/Create.vue"),
    },
    {
        path: "/visitors/:id/edit",
        name: "visitors.edit",
        component: () => import("../pages/Visitors/Edit.vue"),
    },
    {
        path: "/users",
        name: "users.index",
        component: () => import("../pages/Users/Index.vue"),
    },
    {
        path: "/users/create",
        name: "users.create",
        component: () => import("../pages/Users/Create.vue"),
    },
    {
        path: "/users/:id/edit",
        name: "users.edit",
        component: () => import("../pages/Users/Edit.vue"),
    },
    {
        path: "/reports",
        name: "reports",
        component: () => import("../pages/Reports.vue"),
    },
    {
        path: "/cctv",
        name: "cctv",
        component: () => import("../pages/CCTV.vue"),
    },
    {
        path: "/about",
        name: "about",
        component: () => import("../pages/About.vue"),
    },
    {
        path: "/notifications",
        name: "notifications",
        component: () => import("../pages/Notifications.vue"),
    },
    {
        path: "/profile",
        name: "profile",
        component: () => import("../pages/Profile.vue"),
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/Login.vue"),
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
