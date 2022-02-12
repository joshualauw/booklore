import axios from "axios";
import { ref } from "vue";

const userProfile = ref("");
const userWritings = ref([]);
export default function useProfile() {
    const profileLoading = ref(false);

    const getUser = async (id) => {
        profileLoading.value = true;
        try {
            const res = await axios.get("http://127.0.0.1:8000/api/user/" + id);
            userProfile.value = res.data;
            profileLoading.value = false;
        } catch (err) {
            console.log("Error at profileProvider: " + err);
            profileLoading.value = false;
        }
    };

    const getUserWritings = async (id, queryAll) => {
        profileLoading.value = true;
        try {
            const res = await axios.get(
                "http://127.0.0.1:8000/api/book/byUser/" + id,
                {
                    params: {
                        queryAll,
                    },
                }
            );
            userWritings.value = [];
            for (let i in res.data) {
                userWritings.value.push(res.data[i]);
            }
            profileLoading.value = false;
        } catch (err) {
            console.log("Error at profileProvider: " + err);
            profileLoading.value = false;
        }
    };

    return {
        userProfile,
        userWritings,
        profileLoading,
        getUser,
        getUserWritings,
    };
}
