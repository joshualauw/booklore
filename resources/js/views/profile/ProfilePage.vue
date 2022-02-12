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
                {{ userProfile.followers.length }}
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
            <div v-if="user.notifications && user.notifications.length > 0">
                <button
                    @click="readFollowerNotify"
                    class="hover:underline text-primary my-3"
                >
                    Mark as Read
                </button>
                <p
                    v-for="notify in user.notifications"
                    :key="notify"
                    class="text-white px-2 py-1 rounded-lg bg-primary mb-2"
                >
                    {{ notify.data.message }}
                </p>
            </div>
            <p class="mt-4 mb-1 text-lg font-semibold">
                {{ userProfile.username }} Followers
            </p>
            <p
                v-if="
                    userProfile.followers && userProfile.followers.length == 0
                "
                class="my-2 text-lg"
            >
                -
            </p>
            <img
                v-else
                :src="follow.profile"
                :alt="follow.username"
                @click="toProfileLink(follow.id)"
                v-for="follow in userProfile.followers"
                :key="follow.id"
                class="inline-flex w-7 h-7 rounded-full cursor-pointer mr-3"
            />
            <p class="mt-4 mb-1 text-lg font-semibold">
                {{ userProfile.username }} Followings
            </p>
            <p
                v-if="
                    userProfile.followings && userProfile.followings.length == 0
                "
                class="my-2 text-lg"
            >
                -
            </p>
            <img
                v-else
                :src="follow.profile"
                :alt="follow.username"
                @click="toProfileLink(follow.id)"
                v-for="follow in userProfile.followings"
                :key="follow.id"
                class="inline-flex w-7 h-7 rounded-full cursor-pointer mr-3"
            />
        </div>
        <div
            v-if="userProfile.writings"
            class="w-full md:w-2/3 bg-white rounded-lg shadow-lg mt-5 p-5"
        >
            <div v-if="user.id && userProfile.id != user.id">
                <button
                    v-if="!isFollowed(userProfile)"
                    @click="followUser(userProfile)"
                    class="bg-green-500 px-4 py-1 rounded-lg shadow-sm hover:opacity-80 mb-3 text-white"
                >
                    Follow
                    <i class="fa-solid fa-plus ml-1"></i>
                </button>
                <button
                    v-else
                    @click="unfollowUser(userProfile)"
                    class="bg-primary px-4 py-1 rounded-lg shadow-sm hover:opacity-80 mb-3 text-white"
                >
                    Unfollow
                    <i class="fa-solid fa-check ml-1"></i>
                </button>
            </div>
            <h1 class="text-2xl font-semibold">
                Book written by {{ userProfile.username }}
            </h1>
            <h3 class="text-sm text-slate-500 mt-1 mb-5">
                {{ userProfile.writings.length }} public
            </h3>
            <div class="flex flex-col space-y-8">
                <book-cols v-if="!isLoading" :books="userWritings"></book-cols>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onBeforeRouteUpdate, useRouter } from "vue-router";
import useAuth from "../../compossable/auth";
import useFollows from "../../compossable/follows";
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
        const { followUser, unfollowUser, isFollowed, readFollowerNotify } =
            useFollows();
        const writingLoading = ref(false);

        const router = useRouter();

        const toProfileLink = (profileId) => {
            router.push({ name: "profile", params: { id: profileId } });
        };

        getUser(props.id).then(() => {
            getUserWritings(userProfile.value.id);
        });

        onBeforeRouteUpdate((to, from, next) => {
            getUser(to.params.id).then(() => {
                getUserWritings(userProfile.value.id);
                next();
            });
        });

        return {
            userProfile,
            userWritings,
            user,
            isLoading: profileLoading,
            toProfileLink,
            isFollowed,
            followUser,
            unfollowUser,
            readFollowerNotify,
        };
    },
};
</script>
