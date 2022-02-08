<template>
    <form @submit.prevent="submitForm">
        <div class="space-y-3 mb-3">
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
                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>
                <input
                    class="placeholder:text-slate-400 w-full block rounded-md text-black bg-white border border-slate-300 py-2 pr-4 pl-10 shadow-sm focus:outline-none focus:ring-slate-500 focus:ring-1"
                    placeholder="Username"
                    type="text"
                    v-model.trim="form.username"
                />
            </label>
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
                    placeholder="Password Confirmation"
                    type="password"
                    v-model.trim="form.password_confirmation"
                />
            </label>
            <label class="relative block w-full">
                <span
                    class="absolute inset-y-0 left-1 flex items-center pl-2 text-gray-800"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                        />
                    </svg>
                </span>
                <input
                    class="placeholder:text-slate-400 block rounded-md text-black bg-white w-full border border-slate-300 py-2 pr-4 pl-10 shadow-sm focus:outline-none focus:ring-slate-500 focus:ring-1"
                    placeholder="Phone"
                    type="number"
                    v-model.trim="form.phone"
                />
            </label>
            <button
                type="submit"
                class="py-2 px-4 mt-3 text-white text-center w-full rounded-lg shadow-sm bg-primary hover:opacity-80"
            >
                <p v-if="!isLoading">Register</p>
                <i v-else class="fas fa-spinner fa-pulse"></i>
            </button>
        </div>
        <p v-for="err in errors" :key="err" class="text-primary text-left">
            *{{ err }}
        </p>
    </form>
</template>

<script>
import { reactive } from "@vue/reactivity";
import useAuth from "../../compossable/auth";
export default {
    emits: ["onSubmit"],
    setup(props, { emit }) {
        const form = reactive({
            username: "",
            email: "",
            password: "",
            password_confirmation: "",
            phone: "",
        });

        const { register, errors, isLoading } = useAuth();

        const submitForm = async () => {
            const success = await register({
                username: form.username,
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation,
                phone: form.phone,
            });
            if (success) {
                form.username = "";
                form.email = "";
                form.password = "";
                form.password_confirmation = "";
                form.phone = "";
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
