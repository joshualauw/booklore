<template>
    <div
        v-if="isLoading"
        class="w-full h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <form
        v-else
        @submit.prevent="tooglePublishChapter(bookChapter.id)"
        class="mx-8 md:mx-40 my-6 md:my-16 flex flex-col justify-center"
    >
        <div class="flex justify-between items-center">
            <button>
                Chapter Status:
                <span v-if="bookChapter.isPublic" class="text-sky-600"
                    >Public</span
                >
                <span v-else class="text-primary">Draft</span>
            </button>
        </div>
        <p class="text-gray-500 text-sm text-center mb-3">
            Focus to component and press ctrl+s to save
        </p>
        <div class="flex items-center mb-4">
            <input
                type="text"
                class="border-b-2 py-2 text-lg text-center w-full outline-none"
                placeholder="Title"
                v-model="title"
            />
        </div>
        <quill-editor
            v-if="!editorLoading"
            @keydown.ctrl.s.prevent.stop="save"
            theme="bubble"
            class="min-h-[500px] w-full"
            placeholder="Write text here.."
            v-model:content="text"
            contentType="html"
        >
        </quill-editor>
    </form>
</template>

<script>
import useChapter from "../../compossable/chapter";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.bubble.css";
import { ref } from "@vue/reactivity";

export default {
    components: {
        QuillEditor,
    },
    props: ["id"],
    setup(props) {
        const {
            getChapter,
            saveChapter,
            bookChapter,
            chapterLoading,
            tooglePublishChapter,
        } = useChapter();
        const title = ref("");
        const text = ref("");
        const editorLoading = ref(false);

        editorLoading.value = true;
        getChapter(props.id).then(() => {
            title.value = bookChapter.value.title;
            text.value = bookChapter.value.text;
            editorLoading.value = false;
        });

        const save = async () => {
            const success = await saveChapter(props.id, {
                title: title.value,
                text: text.value,
            });
            if (success) {
                alert("progress has been saved");
            }
        };

        return {
            title,
            text,
            save,
            bookChapter,
            editorLoading,
            tooglePublishChapter,
            isLoading: chapterLoading,
        };
    },
};
</script>
