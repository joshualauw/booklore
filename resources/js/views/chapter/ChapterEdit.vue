<template>
    <div
        v-if="isLoading"
        class="w-full h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div
        v-else
        class="mx-8 md:mx-40 my-6 md:my-16 flex flex-col justify-center"
    >
        <div class="flex items-center mb-4">
            <p class="text-xl font-semibold">Title:</p>
            <input
                type="text"
                class="ml-3 py-2 px-3 text-lg w-full outline-none"
            />
        </div>
        <quill-editor
            theme="bubble"
            :options="options"
            class="min-h-[500px] w-full border-t-2 text-2xl"
        >
            <div class="ql-container text-lg"></div>
        </quill-editor>
    </div>
</template>

<script>
import useChapter from "../../compossable/chapter";

export default {
    props: ["id"],
    setup(props) {
        const { getChapter, bookChapter, chapterLoading } = useChapter();

        getChapter(props.id);

        const options = {
            placeholder: "Start Writing here..",
        };

        return {
            bookChapter,
            options,
            isLoading: chapterLoading,
        };
    },
};
</script>
