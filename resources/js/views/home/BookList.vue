<template>
    <div
        class="flex p-8 bg-smoothgray rounded-xl overflow-y-hidden overflow-x-auto"
    >
        <div
            class="whitespace-nowrap h-full inline-flex space-x-7 md:space-x-10"
        >
            <div
                v-for="book in books"
                :key="book.id"
                @click="openBookDialog(book)"
                class="w-32 md:w-[12.5rem] h-48 md:h-72 shadow-lg"
            >
                <img
                    :src="book.image"
                    class="w-full h-full hover:opacity-90 cursor-pointer hover:-rotate-1 transition-transform"
                    :alt="book.title"
                />
            </div>
        </div>
        <teleport to="#app">
            <the-modal v-if="bookDialogOpen">
                <div
                    class="p-6 bg-lightgray rounded-lg h-full relative flex flex-col justify-center items-start space-x-0 space-y-4 md:space-x-5 md:space-y-0 md:flex-row"
                >
                    <img
                        :src="bookDetail.image"
                        class="w-40 md:w-56 h-full self-center"
                        :alt="bookDetail.title"
                    />
                    <div class="h-full w-full">
                        <p
                            class="text-xl text-center md:text-left font-semibold mb-3 text-ellipsis overflow-hidden"
                        >
                            {{ limitText(bookDetail.title, 20) }}
                        </p>
                        <div
                            class="flex space-x-5 justify-center items-center pb-2 border-b-2 mb-2"
                        >
                            <p class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-1"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                                    /></svg
                                >{{ bookDetail.chapters }} chapters
                            </p>
                            <p class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-1"
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
                                    /></svg
                                >{{ bookDetail.views }}
                            </p>
                            <p class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                    /></svg
                                >{{ bookDetail.votes }}
                            </p>
                        </div>
                        <book-tag
                            v-for="tag in bookDetail.tags"
                            :key="tag"
                            :tag="tag"
                            class="inline-flex mr-2"
                        >
                        </book-tag>
                        <p
                            class="text-justify text-ellipsis overflow-hidden mt-2"
                        >
                            {{ limitText(bookDetail.description, 350) }}
                        </p>
                        <div class="flex space-x-1 w-full mt-4">
                            <button
                                class="px-5 py-2 text-white bg-black w-4/5 font-semibold rounded-l-full hover:opacity-80"
                            >
                                Start Reading
                            </button>
                            <button
                                v-if="!user"
                                @click="openDialog"
                                class="px-5 py-2 text-white bg-black w-1/5 relative font-semibold rounded-r-full hover:opacity-80"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 absolute right-8 top-2.5"
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
                                class="px-5 py-2 text-white bg-black w-1/5 relative font-semibold rounded-r-full hover:opacity-80"
                            >
                                <svg
                                    v-if="!inLibrary(bookDetail.id)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 absolute right-8 top-2.5"
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
                                    class="h-5 w-5 absolute right-8 top-2.5"
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="closeBookDialog"
                        class="h-6 w-6 absolute top-3 right-3 cursor-pointer"
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
        <teleport to="#app">
            <the-modal v-if="loginDialogOpen">
                <div
                    class="p-6 bg-lightgray rounded-lg h-full relative flex flex-col justify-center items-start space-x-0 space-y-4 md:space-x-5 md:space-y-0 md:flex-row"
                >
                    <router-link
                        :to="{ name: 'login' }"
                        class="p-3 text-white bg-primary rounded-lg cursor-pointer hover:opacity-80"
                        >Login to Continue</router-link
                    >
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
import { computed, ref } from "vue";
import useBooks from "../../compossable/books";
import BookTag from "./BookTag.vue";
import { useRouter } from "vue-router";
import useLibrary from "../../compossable/library";
import useAuth from "../../compossable/auth";
export default {
    components: {
        BookTag,
    },
    props: ["books"],
    setup(props) {
        const bookDialogOpen = ref(false);
        const loginDialogOpen = ref(false);
        const bookDetail = ref(null);
        const books = computed(() => props.books);
        const { limitText } = useBooks();
        const { user } = useAuth();
        const { addOrRemoveLibrary, inLibrary } = useLibrary();

        const openBookDialog = (book) => {
            bookDialogOpen.value = true;
            bookDetail.value = book;
        };

        const openDialog = () => {
            bookDialogOpen.value = false;
            loginDialogOpen.value = true;
        };
        const closeDialog = () => {
            loginDialogOpen.value = false;
        };

        const router = useRouter();
        const toBookDetail = (id) => {
            router.push({ name: "bookDetail", params: { id } });
        };

        const closeBookDialog = () => {
            bookDialogOpen.value = false;
        };
        return {
            books,
            openBookDialog,
            closeBookDialog,
            bookDialogOpen,
            bookDetail,
            limitText,
            toBookDetail,
            addOrRemoveLibrary,
            openDialog,
            loginDialogOpen,
            closeDialog,
            inLibrary,
            user,
        };
    },
};
</script>
