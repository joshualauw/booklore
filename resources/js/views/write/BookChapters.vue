<template>
    <div class="bg-white rounded-lg shadow-lg w-full mt-10 p-5">
        <div class="flex items-center justify-between mb-5">
            <h1 class="text-2xl font-semibold">Table of Contents</h1>
            <button
                @click="addChapter"
                class="px-3 py-2 rounded-lg bg-lightgray hover:opacity-80"
            >
                Add Chapter +
            </button>
        </div>
        <router-link
            :to="{ name: 'chapterEdit', params: { id: chapter.id } }"
            v-for="chapter in bookChapters"
            :key="chapter.id"
            class="my-2 text-lg w-full p-2 hover:bg-lightgray flex items-center justify-between cursor-pointer rounded-lg"
        >
            {{ chapter.title }}

            <div
                class="flex space-x-2 md:space-x-5 justify-center items-center mb-2"
            >
                <p
                    v-if="!chapter.isPublic"
                    class="bg-secondary text-sm rounded-full px-2"
                >
                    Draft
                </p>
                <p v-else class="bg-sky-200 text-sm rounded-full px-2">
                    Public
                </p>
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
                    <p class="text-sm md:text-base">{{ chapter.views }}</p>
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
                    <p class="text-sm md:text-base">{{ chapter.votes }}</p>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
import { useRouter } from "vue-router";
import useChapter from "../../compossable/chapter";
export default {
    props: ["id"],
    setup(props) {
        const { getChaptersByBookId, bookChapters, createChapter } =
            useChapter();
        const router = useRouter();
        getChaptersByBookId(props.id, true);

        const addChapter = async () => {
            await createChapter({
                book_id: props.id,
            });
        };

        return {
            bookChapters,
            addChapter,
        };
    },
};
</script>
