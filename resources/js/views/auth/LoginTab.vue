<template>
    <form @submit.prevent="submitForm">
        <div class="space-y-3">
            <label class="relative block w-full">
                <span
                    class="absolute inset-y-0 left-1 flex items-center pl-2 text-gray-800"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                        />
                    </svg>
                </span>
                <input
                    class="placeholder:text-slate-400 block rounded-md text-black bg-white w-full border border-slate-300 py-2 pr-4 pl-10 shadow-sm focus:outline-none focus:ring-slate-500 focus:ring-1"
                    placeholder="Email"
                    type="email"
                    v-model.trim="form.email"
                />
            </label>
            <label class="relative block w-full">
                <span
                    class="absolute inset-y-0 left-1 flex items-center pl-2 text-gray-800"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>
                <input
                    class="placeholder:text-slate-400 block rounded-md text-black bg-white w-full border border-slate-300 py-2 pr-4 pl-10 shadow-sm focus:outline-none focus:ring-slate-500 focus:ring-1"
                    placeholder="password"
                    type="password"
                    v-model.trim="form.password"
                />
            </label>
            <button
                type="submit"
                class="py-2 px-4 mt-3 text-white text-center w-full rounded-lg shadow-sm bg-primary hover:opacity-80"
            >
                <p v-if="!isLoading">Login</p>
                <i v-else class="fas fa-spinner fa-pulse"></i>
            </button>
            <p v-for="err in errors" :key="err" class="text-primary">
                *{{ err }}
            </p>
        </div>
    </form>
</template>

<script>
import { reactive } from "@vue/reactivity";
import useAuth from "../../compossable/auth";
export default {
    emits: ["onSubmit"],
    setup(props, { emit }) {
        const form = reactive({
            email: "",
            password: "",
        });

        const { login, errors, isLoading } = useAuth();

        const submitForm = async () => {
            const success = await login({
                email: form.email,
                password: form.password,
            });
            if (success) {
                form.email = "";
                form.password = "";
                emit("onSubmit");
            }
        };

        return {
            form,
            submitForm,
            errors,
            isLoading,
        };
    },
};
</script>
