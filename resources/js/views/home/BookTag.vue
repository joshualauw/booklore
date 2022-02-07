<template>
    <router-link
        :to="{ name: 'bookSearch', query: { tags: [tag] } }"
        class="rounded-full px-2 py-0.5 text-sm bg-secondary cursor-pointer hover:opacity-90"
    >
        {{ tag }}
    </router-link>
</template>

<script>
import { computed } from "@vue/runtime-core";
export default {
    props: ["tag"],
    setup(props) {
        // const backgroundColor = computed(() => {
        //     if (props.tag.toLowerCase() == "fantasy") {
        //         return "red-500";
        //     } else if (props.tag.toLowerCase() == "romance") {
        //         return "#f472b6";
        //     } else if (props.tag.toLowerCase() == "thriller") {
        //         return "#94a3b8";
        //     } else if (props.tag.toLowerCase() == "horror") {
        //         return "#374151";
        //     } else if (props.tag.toLowerCase() == "comedy") {
        //         return "#fde047";
        //     } else if (props.tag.toLowerCase() == "action") {
        //         return "#ef4444";
        //     } else if (props.tag.toLowerCase() == "mystery") {
        //         return "#06b6d4";
        //     } else if (props.tag.toLowerCase() == "adventure") {
        //         return "#22c55e";
        //     }
        // });

        // const textColor = computed(() => {
        //     if (props.tag.toLowerCase() == "horror") {
        //         return "#ffffff";
        //     }
        //     return "#000000";
        // });

        return {
            // backgroundColor,
            // textColor,
            tag: props.tag,
        };
    },
};
</script>
