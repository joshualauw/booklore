import axios from "axios";
import { ref } from "vue";

const bookChapters = ref([]);
const bookChapter = ref("");

export default function useChapter() {
    const chapterLoading = ref(false);

    const getChaptersByBookId = async (id) => {
        chapterLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/chapter/byBook/" + id
            );
            bookChapters.value = [];
            for (let i in res.data) {
                bookChapters.value.push(res.data[i]);
            }
            chapterLoading.value = false;
        } catch (err) {
            console.log("Error at chapterProvider: " + err);
            chapterLoading.value = false;
        }
    };

    const getChapter = async (id) => {
        chapterLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/chapter/" + id
            );
            bookChapter.value = "";
            bookChapter.value = res.data;
            chapterLoading.value = false;
        } catch (err) {
            console.log("Error at chapterProvider: " + err);
            chapterLoading.value = false;
        }
    };

    return {
        bookChapters,
        bookChapter,
        chapterLoading,
        getChaptersByBookId,
        getChapter,
    };
}
