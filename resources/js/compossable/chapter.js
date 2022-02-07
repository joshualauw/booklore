import axios from "axios";
import { ref } from "vue";

const bookChapters = ref([]);
export default function useChapter() {
    const chapterLoading = ref(false);

    const getChaptersByBookId = async (id) => {
        chapterLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/chapters/byBook/" + id
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

    return {
        bookChapters,
        chapterLoading,
        getChaptersByBookId,
    };
}
