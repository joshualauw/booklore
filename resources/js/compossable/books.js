import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const latestBooks = ref([]);
const highlyRatedBooks = ref([]);
const randomBook = ref({});
const queryBooks = ref([]);
const bookDetail = ref({});

export default function useBooks() {
    const isLoading = ref(false);
    const router = useRouter();

    const getLatestBooks = async () => {
        isLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/book/latest"
            );
            latestBooks.value = [];
            for (let i in res.data) {
                latestBooks.value.push(res.data[i]);
            }
            isLoading.value = false;
        } catch (err) {
            console.log("Error at bookProvider: " + err);
            isLoading.value = false;
        }
    };

    const getHighlyRatedBooks = async () => {
        isLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/book/highlyrated"
            );
            highlyRatedBooks.value = [];
            for (let i in res.data) {
                highlyRatedBooks.value.push(res.data[i]);
            }
            isLoading.value = false;
        } catch (err) {
            console.log("Error at bookProvider: " + err);
            isLoading.value = false;
        }
    };

    const toBookDetail = (id) => {
        router.push({ name: "bookDetail", params: { id } });
    };

    const getBookByTag = async (data) => {
        isLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/book/byTag",
                {
                    params: data,
                }
            );
            queryBooks.value = [];
            for (let i in res.data) {
                queryBooks.value.push(res.data[i]);
            }
            isLoading.value = false;
        } catch (err) {
            console.log("Error at bookProvider: " + err);
            isLoading.value = false;
        }
    };

    const getBook = async (id) => {
        isLoading.value = true;
        try {
            if (id) {
                const res = await axios.get(
                    "http://127.0.0.1:8000/api/book/" + id
                );
                bookDetail.value = {};
                bookDetail.value = res.data;
                isLoading.value = false;
            }
        } catch (err) {
            console.log("Error at bookProvider: " + err);
            isLoading.value = false;
        }
    };

    const getRandomBook = async () => {
        isLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/book/random"
            );
            randomBook.value = {};
            randomBook.value = res.data;
            isLoading.value = false;
        } catch (err) {
            console.log("Error at bookProvider: " + err);
            isLoading.value = false;
        }
    };

    const limitText = (str, limit) => {
        if (str) {
            if (str.length > limit) {
                return str.substring(0, limit) + "...";
            }
            return str;
        }
    };

    return {
        isLoading,
        latestBooks,
        randomBook,
        highlyRatedBooks,
        bookDetail,
        queryBooks,
        getLatestBooks,
        getRandomBook,
        getHighlyRatedBooks,
        getBook,
        getBookByTag,
        limitText,
        toBookDetail,
    };
}
