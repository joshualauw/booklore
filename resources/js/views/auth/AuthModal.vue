<template>
    <div class="flex flex-col w-full px-0 md:px-6">
        <h1 class="text-xl font-semibold my-3">Sign In To continue</h1>
        <div class="flex mt-2">
            <div
                @click="setTabActive('login')"
                class="w-1/2 text-center cursor-pointer py-2 rounded-l-full"
                :class="{
                    'bg-primary text-white': tabActive == 'login',
                    'border-2 bg-white ': tabActive != 'login',
                }"
            >
                Login
            </div>
            <div
                @click="setTabActive('register')"
                class="w-1/2 text-center cursor-pointer py-2 rounded-r-full"
                :class="{
                    'bg-primary text-white': tabActive == 'register',
                    'border-2 bg-white ': tabActive != 'register',
                }"
            >
                Register
            </div>
        </div>
        <div class="my-3 p-3">
            <keep-alive>
                <login-tab
                    @onSubmit="loginSuccess"
                    v-if="tabActive == 'login'"
                ></login-tab>
                <register-tab @onSubmit="registerSuccess" v-else></register-tab>
            </keep-alive>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import LoginTab from "./LoginTab.vue";
import RegisterTab from "./RegisterTab.vue";

export default {
    emits: ["loginSuccess"],
    components: {
        LoginTab,
        RegisterTab,
    },
    setup(props, { emit }) {
        const tabActive = ref("login");
        const setTabActive = (active) => {
            tabActive.value = active;
        };

        const loginSuccess = () => {
            emit("loginSuccess");
        };

        const registerSuccess = () => {
            tabActive.value = "login";
        };

        return {
            setTabActive,
            tabActive,
            loginSuccess,
            registerSuccess,
        };
    },
};
</script>
