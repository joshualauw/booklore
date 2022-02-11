<template>
    <div
        v-if="isLoading"
        class="w-full h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div v-else class="mx-12 md:mx-56 my-12">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold mb-5">Your Books</h1>
            <router-link
                :to="{ name: 'write.new' }"
                class="px-3 py-1 rounded-lg bg-primary text-white hover:opacity-80"
            >
                Write a Story
            </router-link>
        </div>
        <div class="bg-white rounded-lg shadow-lg mt-5 p-5">
            <div
                v-for="book in userWritings"
                :key="book.id"
                class="flex justify-between border-b-2 py-6"
            >
                <div class="flex space-x-4">
                    <img
                        :src="book.image"
                        :alt="book.title"
                        class="w-24 h-36"
                    />
                    <div>
                        <p class="text-lg font-semibold mb-2">
                            {{ book.title }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="text-sky-600 font-semibold"
                                >{{ book.chapters }} public chapters</span
                            >
                            - {{ book.drafts }} drafts
                        </p>
                        <p class="text-sm text-gray-600 mb-3">
                            last updated: {{ book.chapterLastUpdate }}
                        </p>
                        <div class="flex space-x-2 md:space-x-5 mb-2 w-full">
                            <div class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-3 w-3 md:h-4 md:w-4 mr-1"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                                    />
                                </svg>
                                <p class="text-sm">
                                    {{ book.chapters }}
                                </p>
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
                <div
                    class="flex flex-col justify-center items-center space-y-4"
                >
                    <router-link
                        :to="{ name: 'write.new', params: { id: book.id } }"
                        class="px-3 py-3 md:py-2 rounded-lg flex justify-between items-center text-center bg-lightgray hover:opacity-80 w-full"
                    >
                        <span class="hidden md:block">Edit Story</span>
                        <i class="fa-solid fa-pencil md:ml-5"></i>
                    </router-link>
                    <button
                        class="px-3 py-3 md:py-2 rounded-lg flex justify-between items-center text-center bg-primary text-white hover:opacity-80 w-full"
                    >
                        <span class="hidden md:block">Delete Story</span>
                        <i class="fa-solid fa-trash-can md:ml-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useAuth from "../../compossable/auth";
import useProfile from "../../compossable/profile";
export default {
    setup() {
        const { getUserWritings, userWritings, profileLoading } = useProfile();
        const { user } = useAuth();
        getUserWritings(user.value.id);

        return {
            userWritings,
            isLoading: profileLoading,
        };
    },
};
</script>
