<template>
    <div class="mx-12 md:mx-56 my-12">
        <form
            enctype="multipart/form-data"
            @submit.prevent="submitForm"
            class="flex flex-col md:flex-row justify-center items-center md:items-start mb-3 md:space-x-12"
        >
            <div class="flex flex-col">
                <div
                    class="relative w-64 h-[375px] bg-lightgray rounded-md flex flex-col justify-center items-center"
                >
                    <i class="fa-solid fa-plus fa-2xl"></i>
                    <p class="font-semibold mt-8 text-lg">Upload Cover</p>
                    <button
                        v-if="showPreview"
                        class="rounded-full absolute bottom-3 left-3 w-10 h-10 flex justify-center items-center mt-5 bg-primary text-white hover:scale-110 z-20"
                    >
                        <i class="fa-solid fa-pencil"></i>
                        <input
                            type="file"
                            ref="newCover"
                            @change="handleFileUpload"
                            class="w-full h-full opacity-0 absolute"
                        />
                    </button>
                    <input
                        type="file"
                        ref="newCover"
                        v-if="!showPreview"
                        @change="handleFileUpload"
                        class="w-full h-full opacity-0 absolute"
                    />
                    <div
                        class="absolute w-full h-full bg-center bg-cover bg-no-repeat"
                        v-if="showPreview"
                        :style="'background-image: url(' + imagePreview + ')'"
                    ></div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg w-full md:w-2/3 p-5">
                <h1 class="text-2xl font-semibold mb-4">Story Detail</h1>
                <div class="space-y-5">
                    <div>
                        <p class="mb-1">Title</p>
                        <input
                            type="text"
                            class="rounded-md border-2 p-2 w-full"
                            v-model="newTitle"
                        />
                    </div>
                    <div>
                        <p class="mb-1">Description</p>
                        <textarea
                            type="text"
                            class="rounded-md h-52 border-2 p-2 w-full resize-none"
                            v-model="newDescription"
                        />
                    </div>
                    <div>
                        <p class="mb-1">Tags</p>
                        <div class="flex border-2 rounded-md mb-3">
                            <select
                                class="p-2 w-full cursor-pointer"
                                v-model="newTag"
                            >
                                <option value="">Select some Tags..</option>
                                <option
                                    v-for="tag in tags"
                                    :key="tag"
                                    :value="tag"
                                >
                                    {{ tag }}
                                </option>
                            </select>
                            <button
                                @click="addTags"
                                type="button"
                                class="p-2 w-16 hover:bg-lightgray"
                            >
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div
                            v-for="tag in storyTag"
                            :key="tag"
                            @click="removeTags(tag)"
                            class="inline-flex mb-2 items-baseline rounded-full px-2 py-0.5 text-sm bg-secondary cursor-pointer hover:opacity-90 mr-2"
                        >
                            {{ tag }}
                            <i class="fa-solid fa-x fa-xs ml-2"></i>
                        </div>
                        <p
                            v-for="err in errors"
                            :key="err"
                            class="text-primary"
                        >
                            *{{ err }}
                        </p>
                        <button
                            class="bg-primary hover:opacity-80 text-white w-full rounded-md mt-3 p-2"
                        >
                            Update Book
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <book-chapters :id="bookId"></book-chapters>
    </div>
</template>

<script>
import { reactive, ref } from "@vue/reactivity";
import useTags from "../../compossable/tags";
import useBooks from "../../compossable/books";
import useAuth from "../../compossable/auth";
import { useRouter } from "vue-router";
import BookChapters from "./BookChapters.vue";

export default {
    props: ["id"],
    components: {
        BookChapters,
    },
    setup(props) {
        const { tags } = useTags();
        const { updateBook, getBook, bookDetail, updateBookCover, errors } =
            useBooks();
        const { user } = useAuth();
        const router = useRouter();

        const imagePreview = ref("");
        const showPreview = ref(false);
        const storyTag = ref([]);
        const newTag = ref("");
        const newCover = ref("");
        const realCover = ref("");
        const newTitle = ref("");
        const newDescription = ref("");

        if (props.id) {
            getBook(props.id).then(() => {
                console.log(bookDetail.value);
                newTitle.value = bookDetail.value.title;
                newDescription.value = bookDetail.value.description;
                for (let i in bookDetail.value.tags) {
                    storyTag.value.push(bookDetail.value.tags[i]);
                }
                showPreview.value = true;
                imagePreview.value = bookDetail.value.image;
            });
        }

        const addTags = () => {
            let invalid = false;
            for (let i in storyTag.value) {
                if (newTag.value == storyTag.value[i]) {
                    invalid = true;
                }
            }
            if (!newTag.value) {
                invalid = true;
            }
            if (!invalid) {
                storyTag.value.push(newTag.value);
            }
        };

        const submitForm = async () => {
            const res = await updateBook(props.id, {
                title: newTitle.value,
                description: newDescription.value,
                tags: storyTag.value,
            });
            if (res) {
                let data = new FormData();
                data.append("image", realCover.value);
                const res2 = await updateBookCover(res, data);
                if (res2) {
                    alert("Book Updated!");
                    router.push({ name: "write" });
                }
            }
        };

        const handleFileUpload = () => {
            let reader = new FileReader();
            reader.addEventListener(
                "load",
                function () {
                    showPreview.value = true;
                    imagePreview.value = reader.result;
                }.bind(this),
                false
            );

            if (newCover.value.files) {
                if (/\.(jpe?g|png|gif)$/i.test(newCover.value.files[0].name)) {
                    reader.readAsDataURL(newCover.value.files[0]);
                    realCover.value = newCover.value.files[0];
                }
            }
        };

        const removeTags = (oldTag) => {
            for (let i in storyTag.value) {
                if (oldTag == storyTag.value[i]) {
                    storyTag.value.splice(i, 1);
                }
            }
        };

        return {
            tags,
            newTag,
            newCover,
            newTitle,
            newDescription,
            storyTag,
            showPreview,
            imagePreview,
            errors,
            bookId: props.id,
            addTags,
            removeTags,
            submitForm,
            handleFileUpload,
        };
    },
};
</script>
