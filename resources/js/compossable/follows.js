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
            user.value.followings.push(followed);
            followed.followers.push(user.value);
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
            followLoading.value = false;
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

    return {
        followLoading,
        followUser,
        unfollowUser,
        isFollowed,
    };
}
