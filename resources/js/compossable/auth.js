import axios from "axios";
import { computed, ref, watch } from "vue";
import { useRouter } from "vue-router";

const user = ref(0);
const loginPopUp = ref(false);

export default function useAuth() {
    const errors = ref([]);
    const isLoading = ref(false);
    const router = useRouter();

    const login = async (data) => {
        isLoading.value = true;
        try {
            const res = await axios.post(
                "http://127.0.0.1:8000/api/login",
                data
            );
            isLoading.value = false;
            alert("Login succesful!");
            errors.value = [];
            //set authentication data to session storage
            sessionStorage.setItem("user", JSON.stringify(res.data));
            user.value = res.data.user;
            axios.defaults.headers.common.Authorization = `Bearer ${res.data.token}`;
        } catch (err) {
            const errorsTemp = err.response.data.errors;
            errors.value = [];
            for (let i in errorsTemp) {
                errors.value.push(errorsTemp[i][0]);
            }
            isLoading.value = false;
        }
    };

    const register = async (data) => {
        isLoading.value = true;
        try {
            await axios.post("http://127.0.0.1:8000/api/register", data);
            isLoading.value = false;
            alert("Account succesfully registered!");
        } catch (err) {
            const errorsTemp = err.response.data.errors;
            errors.value = [];
            for (let i in errorsTemp) {
                errors.value.push(errorsTemp[i][0]);
            }
            isLoading.value = false;
        }
    };

    const logout = () => {
        sessionStorage.removeItem("user");
        user.value = 0;
        router.push({ name: "login" });
        alert("Logout succesful");
    };

    return {
        user,
        errors,
        isLoading,
        loginPopUp,
        login,
        register,
        logout,
    };
}
