<template>
    <div
        v-if="isLoading"
        class="w-screen h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div v-else class="mx-12 md:mx-56 my-12">
        <h1 class="text-3xl font-semibold mb-5">Latest books</h1>
        <book-list :books="latestBooks" class="mb-12"></book-list>
        <book-item :book="randomBook" class="mb-12"></book-item>

        <h1 class="text-3xl font-semibold mb-5">Highly Rated books</h1>
        <book-list :books="highlyRatedBooks" class="mb-12"></book-list>
    </div>
</template>

<script>
import useBooks from "../../compossable/books";
import BookList from "./BookList.vue";
import BookItem from "./BookItem.vue";

export default {
    components: {
        BookList,
        BookItem,
    },
    setup() {
        const { latestBooks, randomBook, highlyRatedBooks, isLoading } =
            useBooks();

        return {
            isLoading,
            latestBooks,
            randomBook,
            highlyRatedBooks,
        };
    },
};
</script>
