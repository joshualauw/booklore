<template>
    <router-view></router-view>
</template>

<script>
import useAuth from "./compossable/auth.js";

import axios from "axios";
import useBooks from "./compossable/books.js";
import useTags from "./compossable/tags.js";

export default {
    setup() {
        const { user, logout } = useAuth();
        const {
            getLatestBooks,
            getRandomBook,
            getHighlyRatedBooks,
            getBookByTitle,
        } = useBooks();
        const { getTags } = useTags();

        getTags().then(() => {
            getLatestBooks().then(() => {
                getRandomBook().then(() => {
                    getHighlyRatedBooks().then(() => {
                        getBookByTitle({ title: "" });
                    });
                });
            });
        });

        const userInfo = sessionStorage.getItem("user");
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            sessionStorage.setItem("user", JSON.stringify(userData));
            user.value = userData.user;
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`;
        }
        axios.interceptors.response.use(
            (response) => response,
            (error) => {
                if (error.response.status === 401) {
                    logout();
                }
                return Promise.reject(error);
            }
        );
    },
};
</script>

<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
