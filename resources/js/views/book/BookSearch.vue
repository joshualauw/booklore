<template>
    <div class="mx-12 md:mx-56 my-12">
        <h1 class="text-3xl font-semibold mb-5">Search Books</h1>
        <h1 v-if="queryTitle" class="text-xl font-semibold mb-5">
            Keyword: "{{ queryTitle }}"
        </h1>
        <span
            v-for="tag in tags"
            :key="tag"
            @click="toogleQueryTag(tag, false)"
            :class="{
                'bg-pink-100': isActive(tag),
                'bg-secondary': !isActive(tag),
            }"
            class="relative inline-flex rounded-full pl-2 pr-5 py-0.5 text-sm cursor-pointer hover:opacity-90 mr-4"
        >
            <p>{{ tag }}</p>
            <svg
                v-if="isActive(tag)"
                xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 absolute top-2 right-1"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
            </svg>
            <svg
                v-else
                xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 absolute top-2 right-1"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                />
            </svg>
        </span>
        <div
            v-if="isLoading"
            class="w-full h-screen flex justify-center items-center"
        >
            <loader color="#fbbf24"></loader>
        </div>
        <div v-else>
            <p
                v-if="queryBooks.length == 0"
                class="w-full h-[60vh] flex justify-center items-center text-center text-xl font-semibold"
            >
                Results not Found
            </p>
            <book-grid v-else class="mt-4" :books="queryBooks"></book-grid>
        </div>
    </div>
</template>

<script>
import BookTag from "../home/BookTag.vue";
import BookGrid from "./BookGrid.vue";
import useTags from "../../compossable/tags";
import useBooks from "../../compossable/books";
import useQuery from "../../compossable/query";
import { onBeforeRouteLeave, onBeforeRouteUpdate, useRoute } from "vue-router";
import { ref } from "@vue/reactivity";

export default {
    components: {
        BookTag,
        BookGrid,
    },
    setup() {
        const { tags } = useTags();
        const { queryBooks, queries, queryTitle, isActive, toogleQueryTag } =
            useQuery();
        const { isLoading } = useBooks();

        onBeforeRouteLeave((to, from, next) => {
            queries.value = [];
            queryTitle.value = "";
            next();
        });

        return {
            tags,
            toogleQueryTag,
            isActive,
            queryTitle,
            queryBooks,
            isLoading,
        };
    },
};
</script>
