<template>
    <div
        v-if="isLoading"
        class="w-screen h-screen flex justify-center items-center"
    >
        <loader color="#fbbf24"></loader>
    </div>
    <div
        v-else
        class="flex flex-col justify-center items-center py-20 text-white"
        :style="
            'background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(' +
            userProfile.background +
            ') no-repeat; background-position: center; background-size: cover;'
        "
    >
        <img
            :src="userProfile.profile"
            :alt="userProfile.username"
            class="w-24 h-24 rounded-full mb-3"
        />
        <p class="text-xl font-serif font-bold mb-5">
            {{ userProfile.username }}
        </p>
        <div class="flex w-[400px] items-start justify-center">
            <div class="flex flex-col w-1/3 items-center">
                {{ userProfile.writings.length }}
                <p class="font-semibold">writings</p>
            </div>
            <div class="flex flex-col w-1/3 items-center">
                {{ userProfile.library.length }}
                <p class="font-semibold">library books</p>
            </div>
            <div class="flex flex-col w-1/3 items-center">
                {{ userProfile.follows.length }}
                <p class="font-semibold">Follower</p>
            </div>
        </div>
    </div>
    <div
        class="flex flex-col md:flex-row space-x-0 md:space-x-6 mx-12 md:mx-56 mt-4"
    >
        <div
            class="w-full md:w-1/3 md:h-fit bg-white rounded-lg shadow-lg mt-5 p-5"
        >
            Bio
        </div>
        <div
            v-if="userProfile.writings"
            class="w-full md:w-2/3 bg-white rounded-lg shadow-lg mt-5 p-5"
        >
            <h1 class="text-2xl font-semibold">
                Book written by {{ userProfile.username }}
            </h1>
            <h3 class="text-sm text-slate-500 mt-1 mb-5">
                {{ userProfile.writings.length }} public
                <span v-if="isUser">
                    - {{ userProfile.draft.length }} drafts (only you can seen)
                </span>
            </h3>
            <div class="flex flex-col space-y-8">
                <book-cols v-if="!isLoading" :books="userWritings"></book-cols>
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from "@vue/runtime-core";
import { onBeforeRouteUpdate } from "vue-router";
import useAuth from "../../compossable/auth";
import useProfile from "../../compossable/profile";
import BookCols from "../book/BookCols.vue";

export default {
    props: ["id"],
    components: {
        BookCols,
    },
    setup(props) {
        const {
            userProfile,
            getUser,
            profileLoading,
            getUserWritings,
            userWritings,
        } = useProfile();
        const { user } = useAuth();

        const isUser = computed(() => user.value.id == userProfile.value.id);

        getUser(props.id).then(() => {
            getUserWritings(userProfile.value.id);
        });
        onBeforeRouteUpdate((to, from, next) => {
            getUser(to.params.id).then(() => {
                getUserWritings(userProfile.value.id);
            });
            next();
        });

        return {
            userProfile,
            userWritings,
            user,
            isUser,
            isLoading: profileLoading,
        };
    },
};
</script>
