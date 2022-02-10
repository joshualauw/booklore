<template>
    <router-link
        :to="{ name: 'bookSearch', query: { tags: [tag] } }"
        class="rounded-full px-2 py-0.5 text-sm bg-secondary cursor-pointer hover:opacity-90"
    >
        {{ tag }}
    </router-link>
</template>

<script>
export default {
    props: ["tag"],
    setup(props) {
        return {
            tag: props.tag,
        };
    },
};
</script>
