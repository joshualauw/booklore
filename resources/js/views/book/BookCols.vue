<template>
    <router-link
        :to="{ name: 'bookDetail', params: { id: book.id } }"
        v-for="book in books"
        :key="book.id"
        class="flex space-x-4 cursor-pointer"
    >
        <img :src="book.image" :alt="book.title" class="w-24 h-36 rounded-md" />
        <div>
            <p class="font-bold mb-1">{{ limitText(book.title, 40) }}</p>
            <div class="flex items-center text-sm mb-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 mr-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                    />
                </svg>
                <p>{{ book.chapters }} chapters</p>
            </div>
            <p class="text-xs text-stone-500">
                {{ limitText(book.description, 150) }}
            </p>
        </div>
    </router-link>
</template>

<script>
import { computed } from "@vue/runtime-core";
import useBooks from "../../compossable/books";
export default {
    props: ["books"],
    setup(props) {
        const books = computed(() => props.books);
        const { limitText } = useBooks();

        return {
            books,
            limitText,
        };
    },
};
</script>
