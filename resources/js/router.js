import { createWebHistory, createRouter } from "vue-router";
import login from "./pages/login.vue";
import subscribers from "./pages/subscribers";
import subscriberShow from "./pages/subscribers/show";
import fields from "./pages/fields";
import fieldShow from "./pages/fields/show";
import fieldNew from "./pages/fields/new";
import subscriberNew from "./pages/subscribers/new";
import { useAuthStore } from "./store/useAuth";
import { storeToRefs } from "pinia";

const routes = [
    {
        path: "/",
        name: "subscriber",
        component: subscribers,
        meta: { title: "subscriber", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/subscribers",
        name: "subscribers",
        component: subscribers,
        meta: { title: "subscribers", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/fields",
        name: "fields",
        component: fields,
        meta: { title: "Fields", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         next("/login");
        //     }
        // },
    },
    {
        path: "/subscribers/new",
        name: "subscribers.new",
        component: subscriberNew,
        meta: { title: "subscribers", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/subscribers/:id",
        name: "subscribers.show",
        component: subscriberShow,
        meta: { title: "subscriber", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/fields/:slug",
        name: "fields.show",
        component: fieldShow,
        meta: { title: "fields", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/fields/new",
        name: "fields.new",
        component: fieldNew,
        meta: { title: "fields", authenticated: true },
        // beforeEnter: (to, from, next) => {
        //     const store = useAuthStore();
        //     const { isAuthenticated } = storeToRefs(store);
        //     if (to.meta.authenticated && isAuthenticated.value) {
        //         return true;
        //     } else {
        //         return next("/login");
        //     }
        // },
    },
    {
        path: "/:pathMatch(.*)*",
        name: "subscribers",
        component: subscribers,
        meta: { title: "subscribers", authenticated: true },
    },
    {
        path: "/login",
        name: "login",
        component: login,
        meta: { title: "Login", authenticated: false },
        // beforeEnter: (to, from, next) => {
        //     const token = localStorage.getItem("token");
        //     console.log(token);
        //     if (!token) {
        //         return true;
        //     } else {
        //         next("/subscribers");
        //     }
        // },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// router.beforeEach((to, from, next) => {
//     const store = useAuthStore();
//     const { isAuthenticated } = storeToRefs(store);
//     // A.) if user is logged in...
//     if (isAuthenticated.value) {
//         console.log("level 1", "isLoggedIn: " + isAuthenticated.value);
//         // ... and route requires authentication
//         if (to.meta.authenticated) {
//             console.log(
//                 "level 2",
//                 "routeRequiresAuth: " + to.meta.authenticated
//             );
//             next();
//             // ... and route does not require authentication...
//         } else {
//             console.log(
//                 "level 2",
//                 "routeRequiresAuth: " + to.meta.authenticated
//             );
//             if (to.name === "login") {
//                 console.log("level 3", "routeName: " + to.name);
//                 next("/subscribers"); // its only the login page currently that does not require authentication
//             } else {
//                 console.log("level 3", "routeName: " + to.name);
//                 next();
//             }
//         }
//     }
//     // B.) If user is NOT logged in...
//     else {
//         console.log("level 1", "isLoggedIn: " + isAuthenticated.value);
//         // ... and route requires authentication
//         if (to.meta.authenticated) {
//             console.log(
//                 "level 2",
//                 "routeRequiresAuth: " + to.meta.authenticated
//             );
//             next("/login");
//             // ... and route does not require authentication...
//         } else {
//             next();
//         }
//     }
// });

export default router;
