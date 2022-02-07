import { createWebHistory, createRouter } from "vue-router";
import MainLayout from "./views/layout/MainLayout.vue";
import Home from "./views/Home/HomePage.vue";
import Login from "./views/auth/LoginPage.vue";
import Register from "./views/auth/RegisterPage.vue";
import BookDetail from "./views/book/BookDetail.vue";
import BookSearch from "./views/book/BookSearch.vue";
import LibraryPage from "./views/library/LibraryPage.vue";
import NotFound from "./views/NotFoundPage.vue";

const routes = [
    {
        path: "/",
        component: MainLayout,
        children: [
            {
                path: "/",
                component: Home,
                name: "home",
            },
            {
                path: "/book/:id",
                component: BookDetail,
                name: "bookDetail",
                props: true,
            },
            {
                path: "/search",
                component: BookSearch,
                name: "bookSearch",
            },
            {
                path: "/library",
                component: LibraryPage,
                name: "library",
            },
            {
                path: "/register",
                component: Register,
                name: "register",
            },
            {
                path: "/login",
                component: Login,
                name: "login",
            },
        ],
    },
    {
        path: "/:notFound(.*)",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = sessionStorage.getItem("user");
    if (to.matched.some((record) => record.meta.auth) && !loggedIn) {
        next("/login");
        return;
    }
    next();
});

export default router;