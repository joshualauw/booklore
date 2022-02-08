<template>
    <div
        v-if="isLoading"
        class="w-screen h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div v-else class="mx-12 md:mx-56 my-12">
        <h1 class="text-3xl font-semibold mb-8">Library</h1>
        <div
            class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-8 md:gap-12"
        >
            <div v-for="book in userLibrary" :key="book.id">
                <div class="relative group">
                    <img
                        :src="book.image"
                        :alt="book.title"
                        class="w-72 h-64 rounded-md cursor-pointer shadow-md group-hover:brightness-50"
                    />
                    <router-link
                        :to="{ name: 'bookDetail', params: { id: book.id } }"
                        class="hidden group-hover:block hover:opacity-80 bg-black absolute top-20 inset-x-5 py-1 px-2 rounded-lg border-white border-2 text-white text-center text-sm font-semibold"
                    >
                        Book Detail
                    </router-link>
                    <button
                        class="hidden group-hover:block hover:opacity-80 bg-black absolute top-32 inset-x-5 py-1 px-2 rounded-lg border-white border-2 text-white text-center text-sm font-semibold"
                    >
                        Continue Reading
                    </button>
                </div>
                <div class="flex items-center justify-between px-1 mt-3">
                    <div>
                        <h2 class="font-semibold">
                            {{ limitText(book.title, 30) }}
                        </h2>
                        <p class="text-xs text-gray-500">
                            {{ book.author.username }}
                        </p>
                    </div>
                    <img
                        @click="toUserProfile(book.author.id)"
                        :src="book.author.profile"
                        :alt="book.author.username"
                        class="w-7 h-7 rounded-full cursor-pointer"
                    />
                </div>
                <div
                    class="flex space-x-2 md:space-x-6 mt-2 items-center w-full"
                >
                    <div class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 md:h-4 md:w-4 mr-1"
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
                        <p class="text-sm">{{ book.views }}</p>
                    </div>
                    <div class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 md:h-4 md:w-4 mr-1"
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
                        <p class="text-sm">{{ book.votes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useRouter } from "vue-router";
import useBooks from "../../compossable/books";
import useLibrary from "../../compossable/library";
export default {
    setup() {
        const { userLibrary, getUserLibrary, libraryLoading } = useLibrary();
        const { limitText } = useBooks();
        const router = useRouter();

        getUserLibrary();

        const toUserProfile = (id) => {
            router.push({ name: "profile", params: { id } });
        };

        return {
            userLibrary,
            limitText,
            toUserProfile,
            isLoading: libraryLoading,
        };
    },
};
</script>
