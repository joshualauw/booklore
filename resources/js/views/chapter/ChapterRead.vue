<template>
    <div
        v-if="isLoading"
        class="w-full h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div v-else class="m-8 md:mx-40 md:my-16">
        <p class="text-2xl font-bold text-center mb-3">
            {{ bookChapter.title }}
        </p>
        <div
            class="flex space-x-5 justify-center items-center pb-6 border-b-2 mb-4"
        >
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
                >{{ bookChapter.views }}
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
                >{{ bookChapter.votes }}
            </p>
        </div>
        <div v-html="bookChapter.text" class="min-h-[250px]"></div>
    </div>
</template>

<script>
import useChapter from "../../compossable/chapter";
export default {
    props: ["id"],
    setup(props) {
        const { getChapter, bookChapter, chapterLoading } = useChapter();

        getChapter(props.id);

        return {
            bookChapter,
            isLoading: chapterLoading,
        };
    },
};
</script>
