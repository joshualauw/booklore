import axios from "axios";
import { ref } from "vue";
import useAuth from "./auth";

export default function useFollows() {
    const { user } = useAuth();
    const followLoading = ref(false);

    const followUser = async (followed) => {
        followLoading.value = true;
        try {
            await axios.post("http://127.0.0.1:8000/api/user/follow", {
                user_id: user.value.id,
                followed_id: followed.id,
            });
            user.value.followings.push({
                id: followed.id,
                username: followed.username,
                profile: followed.profile,
            });
            followed.followers.push({
                id: user.value.id,
                username: user.value.username,
                profile: user.value.profile,
            });
            newFollowerNotify(followed);
            sessionStorage.setItem("updatedUser", JSON.stringify(user.value));
            followLoading.value = false;
        } catch (err) {
            console.log("Error at followProvider: " + err);
            followLoading.value = false;
        }
    };

    const unfollowUser = async (followed) => {
        followLoading.value = true;
        try {
            await axios.post("http://127.0.0.1:8000/api/user/unfollow", {
                user_id: user.value.id,
                followed_id: followed.id,
            });
            for (let i in user.value.followings) {
                if (user.value.followings[i].id == followed.id) {
                    user.value.followings.splice(i, 1);
                }
            }
            for (let i in followed.followers) {
                if (followed.followers[i].id == user.value.id) {
                    followed.followers.splice(i, 1);
                }
            }
            sessionStorage.setItem("updatedUser", JSON.stringify(user.value));
            followLoading.value = false;
        } catch (err) {
            console.log("Error at followProvider: " + err);
            followLoading.value = false;
        }
    };

    const newFollowerNotify = async (followed) => {
        followLoading.value = true;
        try {
            await axios.post(
                "http://127.0.0.1:8000/api/user/newFollowerNotify",
                {
                    user_id: followed.id,
                    follower_username: user.value.username,
                }
            );
            followLoading.value = false;
        } catch (err) {
            console.log("Error at followProvider: " + err);
            followLoading.value = false;
        }
    };

    const isFollowed = (userProfile) => {
        for (let i in user.value.followings) {
            if (user.value.followings[i].id == userProfile.id) {
                return true;
            }
        }
        return false;
    };

    const readFollowerNotify = async () => {
        followLoading.value = true;
        try {
            await axios.post(
                "http://127.0.0.1:8000/api/user/readFollowerNotify",
                {
                    user_id: user.value.id,
                }
            );
            user.value.notifications = [];
            sessionStorage.setItem("updatedUser", JSON.stringify(user.value));
            followLoading.value = false;
        } catch (err) {
            console.log("Error at followProvider: " + err);
            followLoading.value = false;
        }
    };

    return {
        followLoading,
        followUser,
        unfollowUser,
        isFollowed,
        readFollowerNotify,
    };
}
