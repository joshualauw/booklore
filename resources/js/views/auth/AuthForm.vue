<template>
    <div
        class="flex flex-col w-4/5 mx-auto lg:w-1/2 mt-16 mb-12 rounded-lg bg-lightgray shadow-md py-8 px-8"
    >
        <h1 class="text-3xl font-semibold text-center mb-6">{{ title }}</h1>
        <form
            @submit.prevent="submitForm"
            class="flex flex-col justify-center items-center space-y-5 mb-3"
        >
            <slot></slot>
        </form>
        <div v-for="err in errors" :key="err" class="text-primary">
            *{{ err }}
        </div>
        <teleport to="#app">
            <the-modal v-if="isLoading">
                <loader color="#fbbf24"></loader>
            </the-modal>
        </teleport>
    </div>
</template>

<script>
import { computed } from "@vue/runtime-core";
export default {
    emits: ["onFormSubmit"],
    props: ["isLoading", "errors", "title"],
    setup(props, { emit }) {
        const isLoading = computed(() => props.isLoading);
        const errors = computed(() => props.errors);

        const submitForm = () => {
            emit("onFormSubmit");
        };

        return {
            submitForm,
            isLoading,
            errors,
            title: props.title,
        };
    },
};
</script>
