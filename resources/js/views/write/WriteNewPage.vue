<template>
    <div class="mx-12 md:mx-56 my-12">
        <div
            class="flex flex-col md:flex-row justify-center items-center md:items-start mb-3 md:space-x-12"
        >
            <div class="flex flex-col">
                <div
                    class="w-60 h-[350px] bg-lightgray rounded-md flex justify-center items-center font-bold"
                >
                    Book Cover
                </div>
                <button
                    class="rounded-full w-14 h-14 self-center border flex justify-center items-center mt-5 bg-lightgray hover:bg-primary hover:text-white transition-colors duration-150"
                >
                    <i class="fa-solid fa-pencil"></i>
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-lg w-full md:w-2/3 p-5">
                <h1 class="text-2xl font-semibold mb-4">Story Detail</h1>
                <form class="space-y-5">
                    <div>
                        <p class="mb-1">Title</p>
                        <input
                            type="text"
                            class="rounded-md border-2 p-2 w-full"
                        />
                    </div>
                    <div>
                        <p class="mb-1">Description</p>
                        <textarea
                            type="text"
                            class="rounded-md h-52 border-2 p-2 w-full resize-none"
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
                        <button
                            class="bg-primary hover:opacity-80 text-white w-full rounded-md mt-3 p-2"
                        >
                            Create now!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import useTags from "../../compossable/tags";
export default {
    setup() {
        const { tags } = useTags();
        const storyTag = ref([]);
        const newTag = ref("");

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
            storyTag,
            addTags,
            removeTags,
        };
    },
};
</script>
