import useBooks from "./books";
import useTags from "./tags";
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";

let queries = ref([]);
export default function useQuery() {
    const route = useRoute();
    const router = useRouter();
    const { tags } = useTags();
    const { queryBooks, getBookByTag } = useBooks();

    const initQueryParams = () => {
        queries.value = [];
        if (typeof route.query.tags === "string") {
            queries.value.push(route.query.tags);
        } else {
            for (let i in route.query.tags) {
                queries.value.push(route.query.tags[i]);
            }
        }
        getBookByTag({ tags: queries.value });
    };

    const isActive = (tag) => {
        for (let i in queries.value) {
            if (queries.value[i] == tag) {
                return true;
            }
        }
        return false;
    };

    const toogleQueryTag = (tag, setOnly) => {
        for (let i in queries.value) {
            if (queries.value[i] == tag) {
                if (setOnly) {
                    router.push({
                        name: "bookSearch",
                        query: { tags: queries.value },
                    });
                    return;
                } else {
                    queries.value.splice(i, 1);
                    router.push({
                        name: "bookSearch",
                        query: { tags: queries.value },
                    });
                    getBookByTag({ tags: queries.value });
                    return;
                }
            }
        }
        queries.value.push(tag);
        router.push({ name: "bookSearch", query: { tags: queries.value } });
        getBookByTag({ tags: queries.value });
    };

    return {
        tags,
        queryBooks,
        queries,
        toogleQueryTag,
        initQueryParams,
        isActive,
    };
}
