import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const bookChapters = ref([]);
const bookChapter = ref("");

export default function useChapter() {
    const chapterLoading = ref(false);
    const router = useRouter();

    const getChaptersByBookId = async (id, queryAll) => {
        chapterLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/chapter/byBook/" + id,
                {
                    params: {
                        queryAll,
                    },
                }
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

    const createChapter = async (data) => {
        chapterLoading.value = true;
        try {
            const res = await axios.post(
                "http://127.0.0.1:8000/api/chapter/create",
                data
            );
            chapterLoading.value = false;
            router.push({ name: "chapterEdit", params: { id: res.data } });
        } catch (err) {
            console.log("Error at chapterProvider: " + err);
            chapterLoading.value = false;
        }
    };

    const tooglePublishChapter = async (id) => {
        chapterLoading.value = true;
        try {
            const res = await axios.put(
                "http://127.0.0.1:8000/api/chapter/publish/" + id
            );
            chapterLoading.value = false;
            bookChapter.value.isPublic = res.data.data;
            alert("chapter has successfully " + res.data.message + "!");
        } catch (err) {
            console.log("Error at chapterProvider: " + err);
            chapterLoading.value = false;
        }
    };

    const saveChapter = async (id, data) => {
        chapterLoading.value = true;
        try {
            await axios.put(
                "http://127.0.0.1:8000/api/chapter/update/" + id,
                data
            );
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
        saveChapter,
        tooglePublishChapter,
        createChapter,
    };
}
