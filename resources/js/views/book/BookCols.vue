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
            <div class="inline-flex items-center text-sm mb-2 mr-2">
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
            <div class="inline-flex items-center text-sm mb-2 mr-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    />
                </svg>
                <p>{{ book.views }}</p>
            </div>
            <div class="inline-flex items-center text-sm mb-2 mr-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                    />
                </svg>
                <p>{{ book.votes }}</p>
            </div>
            <p class="text-xs text-stone-500">
                {{ limitText(book.description, 150) }}
            </p>
        </div>
    </router-link>
</template>

<script>
import useBooks from "../../compossable/books";
export default {
    props: ["books"],
    setup(props) {
        const { limitText } = useBooks();

        return {
            books: props.books,
            limitText,
        };
    },
};
</script>
