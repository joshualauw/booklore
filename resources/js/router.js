import { createWebHistory, createRouter } from "vue-router";
import MainLayout from "./views/layout/MainLayout.vue";
import Home from "./views/Home/HomePage.vue";
import Login from "./views/auth/LoginPage.vue";
import Register from "./views/auth/RegisterPage.vue";
import BookDetail from "./views/book/BookDetail.vue";
import BookSearch from "./views/book/BookSearch.vue";
import LibraryPage from "./views/library/LibraryPage.vue";
import ProfilePage from "./views/profile/ProfilePage.vue";
import WritePage from "./views/write/WritePage.vue";
import WriteNewPage from "./views/write/WriteNewPage.vue";
import UpdatePage from "./views/write/UpdatePage.vue";
import ChapterEdit from "./views/chapter/ChapterEdit.vue";
import ChapterRead from "./views/chapter/ChapterRead.vue";
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
                path: "/write",
                component: WritePage,
                name: "write",
                meta: {
                    auth: true,
                },
            },
            {
                path: "/write/new",
                component: WriteNewPage,
                name: "write.new",
                meta: {
                    auth: true,
                },
            },
            {
                path: "/write/update/:id",
                component: UpdatePage,
                name: "write.update",
                props: true,
                meta: {
                    auth: true,
                },
            },
            {
                path: "/chapter/edit/:id",
                component: ChapterEdit,
                name: "chapterEdit",
                props: true,
                meta: {
                    auth: true,
                },
            },
            {
                path: "/chapter/:id",
                component: ChapterRead,
                name: "chapterRead",
                props: true,
            },
            {
                path: "/library",
                component: LibraryPage,
                name: "library",
                meta: {
                    auth: true,
                },
            },
            {
                path: "/profile/:id",
                component: ProfilePage,
                name: "profile",
                props: true,
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
        next({ name: "login" });
        return;
    }
    next();
});

export default router;
