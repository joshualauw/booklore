<template>
    <div
        v-if="isLoading"
        class="w-screen h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div v-else>
        <div class="py-10 shadow-lg bg-white">
            <div
                class="flex justify-center items-center space-x-4 md:space-x-8"
            >
                <img
                    :src="bookDetail.image"
                    :alt="bookDetail.title"
                    class="w-40 h-60 md:w-52 md:h-72 rounded-lg shadow-lg"
                />
                <div>
                    <h1 class="uppercase text-2xl font-bold">
                        {{ bookDetail.title }}
                    </h1>
                    <div
                        class="flex justify-center items-center mt-12 w-64 md:w-[300px]"
                    >
                        <div
                            class="text-sm flex flex-col justify-center items-center font-semibold border-r-2 px-2"
                        >
                            <div class="flex justify-center items-center">
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
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                                <p class="text-xs ml-2 text-gray-500">Views</p>
                            </div>
                            <p class="text-sm font-semibold">
                                {{ bookDetail.views }}
                            </p>
                        </div>
                        <div
                            class="text-sm flex flex-col justify-center items-center font-semibold border-r-2 px-2"
                        >
                            <div class="flex justify-center items-center">
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
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                    />
                                </svg>
                                <p class="text-xs ml-2 text-gray-500">Votes</p>
                            </div>
                            <p class="text-sm font-semibold">
                                {{ bookDetail.votes }}
                            </p>
                        </div>
                        <div
                            class="text-sm flex flex-col justify-center items-center font-semibold border-r-2 px-2"
                        >
                            <div class="flex justify-center items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                                    />
                                </svg>
                                <p class="text-xs ml-2 text-gray-500">
                                    Chapters
                                </p>
                            </div>
                            <p class="text-sm font-semibold">
                                {{ bookDetail.chapters }}
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-1">
                        <button
                            class="px-5 py-2 text-white bg-black w-4/5 font-semibold mt-8 rounded-l-full hover:opacity-80"
                        >
                            Start Reading
                        </button>
                        <button
                            v-if="!user"
                            @click="openDialog"
                            class="px-5 py-2 text-white bg-black w-1/5 relative font-semibold mt-8 rounded-r-full hover:opacity-80"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute right-5 top-2.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </button>
                        <button
                            v-else
                            @click="addOrRemoveLibrary(bookDetail.id)"
                            class="px-5 py-2 text-white bg-black w-1/5 relative font-semibold mt-8 rounded-r-full hover:opacity-80"
                        >
                            <svg
                                v-if="!inLibrary(bookDetail.id)"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute right-5 top-2.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute right-5 top-2.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM SECTION -->
        <div
            class="mx-12 flex flex-col md:flex-row md:mx-32 mt-10 space-x-0 space-y-5 md:space-x-10 md:space-y-0"
        >
            <div class="flex flex-col w-full md:w-2/3">
                <div class="flex items-center space-x-3">
                    <img
                        :src="bookDetail.author.profile"
                        :alt="bookDetail.author.username"
                        class="w-7 h-7 rounded-full"
                    />
                    <span class="text-lg">{{
                        bookDetail.author.username
                    }}</span>
                </div>
                <p class="mt-8 text-justify">{{ bookDetail.description }}</p>
                <div class="mt-4">
                    <book-tag
                        v-for="tag in bookDetail.tags"
                        :key="tag"
                        :tag="tag"
                        class="inline-flex mr-2"
                    ></book-tag>
                </div>
                <div
                    v-if="chapterLoading"
                    class="w-full h-full flex justify-center items-center"
                >
                    <loader color="#fbbf24"></loader>
                </div>
                <div v-else class="bg-white rounded-lg shadow-lg mt-5 p-5">
                    <div class="mb-5">
                        <span class="text-lg font-semibold"
                            >Table of Contents</span
                        >
                        <span class="ml-5 text-gray-500"
                            >Last updated:
                            {{ bookDetail.chapterLastUpdate }}</span
                        >
                    </div>
                    <p
                        v-for="chapter in bookChapters"
                        :key="chapter.id"
                        class="my-1 text-lg p-2 hover:bg-lightgray cursor-pointer rounded-lg"
                    >
                        {{ chapter.title }}
                    </p>
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <div class="bg-white rounded-lg shadow-lg mt-5 p-5 space-y-10">
                    <h1 class="text-xl font-bold">You may also like</h1>
                    <book-cols :books="books"></book-cols>
                </div>
            </div>
        </div>
        <teleport to="#app">
            <the-modal v-if="dialogIsOpen">
                <div
                    class="p-6 bg-lightgray rounded-lg h-full relative flex flex-col justify-center items-start space-x-0 space-y-4 md:space-x-5 md:space-y-0 md:flex-row"
                >
                    <auth-modal @loginSuccess="loginSuccess"></auth-modal>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="closeDialog"
                        class="w-4 h-4 md:h-6 md:w-6 absolute -top-3 right-1 md:top-3 md:right-3 cursor-pointer"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </div>
            </the-modal>
        </teleport>
    </div>
</template>

<script>
import { computed, ref } from "@vue/runtime-core";
import useBooks from "../../compossable/books";
import useChapter from "../../compossable/chapter";
import useLibrary from "../../compossable/library";
import BookTag from "../home/BookTag.vue";
import BookCols from "./BookCols.vue";
import { onBeforeRouteUpdate, useRouter } from "vue-router";
import useAuth from "../../compossable/auth";
import AuthModal from "../auth/AuthModal.vue";

export default {
    props: ["id"],
    components: {
        BookTag,
        BookCols,
        AuthModal,
    },
    setup(props) {
        const { getBook, bookDetail, isLoading, latestBooks } = useBooks();
        const { limitText } = useBooks();
        const { chapterLoading, getChaptersByBookId, bookChapters } =
            useChapter();
        const { addOrRemoveLibrary, inLibrary } = useLibrary();
        const { user } = useAuth();
        const router = useRouter();

        const dialogIsOpen = ref(false);

        const openDialog = () => {
            dialogIsOpen.value = true;
        };
        const closeDialog = () => {
            dialogIsOpen.value = false;
        };
        const loginSuccess = () => {
            closeDialog();
            // router.push({ name: "bookDetail", params: { id: props.id } });
            router.push({ name: "home" });
        };

        getBook(props.id).then(() => {
            getChaptersByBookId(bookDetail.value.id);
        });

        onBeforeRouteUpdate((to, from, next) => {
            getBook(to.params.id);
            getChaptersByBookId(bookDetail.value.id);
            next();
        });

        const books = computed(() => latestBooks.value.slice(0, 6));

        return {
            bookDetail,
            isLoading,
            chapterLoading,
            bookChapters,
            dialogIsOpen,
            books,
            user,
            limitText,
            openDialog,
            closeDialog,
            inLibrary,
            addOrRemoveLibrary,
            loginSuccess,
        };
    },
};
</script>
