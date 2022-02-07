import axios from "axios";
import { ref } from "vue";

const tags = ref([]);
export default function useTags() {
    const getTags = async () => {
        try {
            const res = await axios.get("http://127.0.0.1:8000/api/tag");
            tags.value = [];
            for (let i in res.data) {
                tags.value.push(res.data[i]);
            }
            // console.log(tags.value);
        } catch (err) {
            console.log("Error at tagProvider: " + err);
        }
    };

    return {
        tags,
        getTags,
    };
}
