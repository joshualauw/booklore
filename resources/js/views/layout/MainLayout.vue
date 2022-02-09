<template>
    <div
        class="py-3 w-full flex justify-center md:justify-between sticky top-0 bg-white items-center shadow-md px-4 md:px-10 z-10"
    >
        <router-link
            v-if="!authRoute"
            class="text-2xl hidden md:flex items-center tracking-wider font-semibold"
            :to="{ name: 'home' }"
            >BOOK<span class="text-primary">LORE</span></router-link
        >
        <router-link
            v-if="authRoute"
            class="text-2xl flex items-center tracking-wider font-semibold"
            :to="{ name: 'home' }"
            >BOOK<span class="text-primary">LORE</span></router-link
        >
        <ul v-if="!authRoute" class="flex items-center space-x-4 md:space-x-8">
            <li>
                <router-link :to="{ name: 'home' }">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 block md:hidden cursor-pointer hover:opacity-80"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </router-link>
            </li>
            <li
                class="flex items-center hover:opacity-80"
                @click="toogleBrowseDropdown"
            >
                <button class="hidden md:block">Browse</button>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 block md:hidden cursor-pointer hover:opacity-80"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"
                    />
                </svg>
                <svg
                    v-if="!browseDropdownActive"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 pt-1 cursor-pointer"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 pt-1 cursor-pointer"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </li>
            <li>
                <label class="relative block">
                    <span
                        class="absolute inset-y-0 left-1 flex items-center pl-2 text-gray-400"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </span>
                    <input
                        class="placeholder:text-slate-400 block rounded-full text-black bg-white w-60 lg:w-80 border border-slate-300 py-1 pr-4 pl-10 shadow-sm focus:outline-none focus:ring-slate-500 focus:ring-1"
                        placeholder="Search here.."
                        type="text"
                        v-model="searchInput"
                        @keyup.enter="querySearch"
                    />
                </label>
            </li>
            <li v-if="user">
                <button class="hidden md:block hover:opacity-80">Write</button>
            </li>
            <li v-if="user">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 block md:hidden cursor-pointer hover:opacity-80"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                    />
                </svg>
            </li>
            <li
                v-if="user"
                class="flex items-center hover:opacity-80 cursor-pointer"
                @click="toogleProfileDropdown"
            >
                <img
                    :src="user.profile"
                    :alt="user.id"
                    class="rounded-full w-6 h-6 md:w-7 md:h-7 bg-white mr-2"
                />
                <div class="flex items-center">
                    <p class="mr-1 hidden lg:block">
                        {{ user.username }}
                    </p>
                    <svg
                        v-if="!profileDropdownActive"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 pt-1"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 pt-1 cursor-pointer"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
            </li>
            <li v-if="!user">
                <router-link class="hover:opacity-80" :to="{ name: 'login' }"
                    >Sign In</router-link
                >
            </li>
        </ul>
        <div
            v-if="profileDropdownActive"
            class="origin-top-right absolute right-6 md:right-16 top-12 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
        >
            <div class="py-1" role="none">
                <router-link
                    :to="{ name: 'profile', params: { id: user.id } }"
                    class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-200 border-gray-200"
                    role="menuitem"
                    tabindex="-1"
                >
                    My Profile
                </router-link>
                <button
                    class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-200 border-gray-200"
                    role="menuitem"
                    tabindex="-1"
                >
                    Inbox
                </button>
                <router-link
                    :to="{ name: 'library' }"
                    class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-200 border-gray-200"
                    role="menuitem"
                    tabindex="-1"
                >
                    Library
                </router-link>
                <button
                    @click="signOut"
                    class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-200 border-t-2 border-gray-200"
                    role="menuitem"
                    tabindex="-1"
                >
                    Logout
                </button>
            </div>
        </div>
        <div
            v-if="browseDropdownActive"
            class="origin-top-right absolute right-[38%] md:right-[33%] top-12 mt-2 w-60 h-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
        >
            <div
                class="py-1 overflow-auto grid grid-cols-2 h-full w-full"
                role="none"
            >
                <router-link
                    v-for="tag in tags"
                    @click="toogleQueryTag(tag, true)"
                    :to="{ name: 'bookSearch', query: { tags: [tag] } }"
                    :key="tag"
                    class="text-gray-700 w-full flex justify-center items-center px-3 text-sm hover:bg-gray-200 border-gray-200"
                    role="menuitem"
                    tabindex="-1"
                >
                    {{ tag }}
                </router-link>
            </div>
        </div>
    </div>
    <router-view></router-view>
    <footer
        v-if="!authRoute"
        class="bg-primary shadow-md h-12 text-white flex justify-center items-center mt-24"
    >
        @Booklore - Joshua william
    </footer>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import {
    onBeforeRouteLeave,
    onBeforeRouteUpdate,
    useRoute,
    useRouter,
} from "vue-router";
import useAuth from "../../compossable/auth";
import useTags from "../../compossable/tags";
import useQuery from "../../compossable/query";
import useBooks from "../../compossable/books";

export default {
    setup() {
        const profileDropdownActive = ref(false);
        const browseDropdownActive = ref(false);
        const searchInput = ref("");

        const route = useRoute();
        const router = useRouter();
        const { user, logout } = useAuth();
        const { tags } = useTags();

        const { toogleQueryTag, initQueryParams, queryTitle, queries } =
            useQuery();
        const { getBookByTitle } = useBooks();
        initQueryParams();

        console.log(user.value);

        const authRoute = computed(() => {
            return route.name == "login" || route.name == "register";
        });

        const querySearch = () => {
            queryTitle.value = searchInput.value;
            router.push({
                name: "bookSearch",
                query: { title: queryTitle.value },
            });
            getBookByTitle({ title: queryTitle.value });
            queries.value = [];
            searchInput.value = "";
        };

        onBeforeRouteUpdate((to, from, next) => {
            profileDropdownActive.value = false;
            browseDropdownActive.value = false;
            window.scrollTo({ top: 0 });
            next();
        });

        const toogleProfileDropdown = () => {
            profileDropdownActive.value = !profileDropdownActive.value;
            browseDropdownActive.value = false;
        };

        const toogleBrowseDropdown = () => {
            browseDropdownActive.value = !browseDropdownActive.value;
            profileDropdownActive.value = false;
        };

        const signOut = () => {
            profileDropdownActive.value = false;
            browseDropdownActive.value = false;
            logout();
        };

        return {
            profileDropdownActive,
            browseDropdownActive,
            tags,
            user,
            authRoute,
            searchInput,
            toogleProfileDropdown,
            toogleBrowseDropdown,
            toogleQueryTag,
            querySearch,
            signOut,
        };
    },
};
</script>
