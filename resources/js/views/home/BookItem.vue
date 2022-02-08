<template>
    <div>
        <div>
            <div
                class="flex justify-center w-full mx-auto items-start space-x-6 p-4 md:p-8"
            >
                <img
                    :src="book.image"
                    :alt="book.title"
                    class="w-36 h-48 md:w-64 md:h-96 cursor-pointer"
                    @click="toBookDetail(book.id)"
                />
                <div class="w-[450px]">
                    <h1
                        class="text-base md:text-2xl text-left font-semibold mb-4"
                    >
                        {{ limitText(book.title, 40) }}
                    </h1>
                    <div
                        class="flex space-x-2 md:space-x-5 justify-center items-center mb-2 w-full pb-2 border-b-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 md:h-6 md:w-6 mr-1"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                                />
                            </svg>
                            <p class="text-sm md:text-base">
                                {{ book.chapters }} chapters
                            </p>
                        </div>
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 md:h-6 md:w-6 mr-1"
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
                            <p class="text-sm md:text-base">{{ book.views }}</p>
                        </div>
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 md:h-6 md:w-6 mr-1"
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
                            <p class="text-sm md:text-base">{{ book.votes }}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <book-tag
                            v-for="tag in book.tags"
                            :key="tag"
                            :tag="tag"
                            class="inline-flex mr-3"
                        >
                        </book-tag>
                    </div>
                    <p class="hidden md:block text-justify my-4">
                        {{ limitText(book.description, 350) }}
                    </p>
                    <div class="text-center md:text-right mt-2">
                        <router-link
                            v-if="book.id"
                            :to="{
                                name: 'bookDetail',
                                params: { id: book.id },
                            }"
                            class="font-semibold"
                            >See Details ></router-link
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="block md:hidden">
            {{ limitText(book.description, 350) }}
        </div>
    </div>
</template>

<script>
import { computed } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import useBooks from "../../compossable/books";
import BookTag from "./BookTag.vue";
export default {
    components: {
        BookTag,
    },
    props: ["book"],
    setup(props) {
        const { limitText, toBookDetail } = useBooks();
        const router = useRouter();

        const book = computed(() => props.book);

        return {
            book,
            limitText,
            toBookDetail,
        };
    },
};
</script>
