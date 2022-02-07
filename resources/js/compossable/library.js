import { ref } from "vue";
import axios from "axios";
import useAuth from "./auth";

const userLibrary = ref([]);
export default function useLibrary() {
    const libraryLoading = ref(false);
    const { user } = useAuth();
    const libraryIds = user.value.library;

    const addLibrary = async (data) => {
        libraryLoading.value = true;
        try {
            const res = await axios.post(
                "http://127.0.0.1:8000/api/library/create",
                data
            );
            user.value.library.push(res.data);
            libraryLoading.value = false;
            alert("book added to library!");
        } catch (err) {
            console.log("Error at libraryProvider: " + err);
            libraryLoading.value = false;
        }
    };

    const removeLibrary = async (data) => {
        libraryLoading.value = true;
        try {
            const res = await axios.post(
                "http://127.0.0.1:8000/api/library/delete",
                data
            );
            for (let i in user.value.library) {
                if (res.data == user.value.library[i]) {
                    user.value.library.splice(i, 1);
                }
            }
            libraryLoading.value = false;
            alert("book removed from library!");
        } catch (err) {
            console.log("Error at libraryProvider: " + err);
            libraryLoading.value = false;
        }
    };

    const getUserLibrary = async () => {
        libraryLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/library/byUser/" + user.value.id
            );
            userLibrary.value = [];
            for (let i in res.data) {
                userLibrary.value.push(res.data[i]);
            }
            libraryLoading.value = false;
        } catch (err) {
            console.log("Error at libraryProvider: " + err);
            libraryLoading.value = false;
        }
    };

    const addOrRemoveLibrary = async (bookId) => {
        const data = {
            user_id: user.value.id,
            book_id: bookId,
        };
        if (!inLibrary(bookId)) {
            await addLibrary(data);
            return;
        }
        await removeLibrary(data);
    };

    const inLibrary = (bookId) => {
        for (let i in libraryIds) {
            if (bookId == libraryIds[i]) {
                return true;
            }
        }
        return false;
    };

    return {
        libraryLoading,
        userLibrary,
        addLibrary,
        removeLibrary,
        inLibrary,
        addOrRemoveLibrary,
        getUserLibrary,
    };
}
