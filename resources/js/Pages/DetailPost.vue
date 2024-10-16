<script setup>
import { ref, watch } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Icon } from "@iconify/vue";
import axios from "axios";

// PrimaryButton
const props = defineProps({
    post: {
        type: Object,
    },
    comments: {
        type: Object,
    },
    liked: {
        type: Boolean,
        required: true,
    },
    likecount: {
        type: Number,
        required: true,
    },
});

const form = useForm({
    content: "",
    posts_id: props.post.id,
});

function submit() {
    form.post("/comment", {
        onSuccess: () => {
            form.reset();
        },
    });
}

const isLiked = ref(props.liked);
const currentlikecount = ref(props.likecount);

watch(() => props.liked, (newVal) => {
    isLiked.value = newVal;
});

watch(() => props.likecount, (newVal) => {
    currentlikecount.value = newVal;
});

const toggleLike = async () => {
    try {
        if (isLiked.value) {
            await axios.post(`/posts/${props.post.id}/unlike`);
            currentlikecount.value--;
        } else {
            await axios.post(`/posts/${props.post.id}/like`);
            currentlikecount.value++;
        }
        isLiked.value = !isLiked.value;
    } catch (error) {
        console.error("Error toggling like:", error);
    }
};
</script>

<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <!-- Left Sidebar -->
            <Sidebar />
            <!-- Main Content -->
            <main class="container flex-1 pt-10">
                <div class="flex max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Left Section (static) -->
                    <div class="w-1/2 p-4 bg-gray-100">
                        <div>
                            <img :src="`/storage/images/posts/${post.images[0].image}`" alt="Post Image"
                                class="w-full object-cover rounded-lg shadow" />
                        </div>
                    </div>
                    <!-- Right Section (scrollable) -->
                    <div class="w-1/2 p-4 h-[500px] overflow-y-auto">
                        <div class="flex items-center mb-4">
                            <img :src="`/storage/images/profiles/${post.profileImage}`" alt="Profile Image"
                                class="w-12 h-12 rounded-full object-cover mr-4" />
                            <div>
                                <p class="text-gray-800 font-semibold">
                                    {{ post.email }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-5" />
                        <div class="flex items-center mb-4">
                            <img :src="`/storage/images/profiles/${post.profileImage}`" alt="Profile Image"
                                class="w-12 h-12 rounded-full object-cover mr-4" />
                            <div>
                                <p class="text-gray-600">{{ post.content }}</p>
                            </div>
                        </div>
                        <Icon :icon="isLiked ? 'mdi:like' : 'mdi:like-outline'" :ssr="true"
                            class="text-2xl mr-2 cursor-pointer" @click="toggleLike" />
                        <p class="text-sm font-semibold">{{ currentlikecount }} likes</p>
                        <hr class="my-5" />
                        <!-- comments -->
                        <div class="mt-5">
                            <h1 class="font-semibold">Comments</h1>
                            <div class="mt-5">
                                <div v-for="comment in comments" :key="comment.id"
                                    class="flex items-center space-x-4 space-y-2">
                                    <img :src="`/storage/images/profiles/${comment.profileImage}`" alt="Profile Image"
                                        class="w-12 h-12 rounded-full object-cover" />
                                    <div>
                                        <p class="text-gray-800 font-semibold">
                                            {{ comment.email }}
                                        </p>
                                        <p class="text-gray-600">
                                            {{ comment.content }}
                                        </p>
                                    </div>
                                </div>

                                <form @submit.prevent="submit">
                                    <div class="">
                                        <textarea id="message" v-model="form.content" rows="4"
                                            class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500"
                                            placeholder="Comments Maksimal 2.200 Karakter "></textarea>

                                        <PrimaryButton class="mt-5 w-full flex justify-center items-center"
                                            type="submit">
                                            Comments
                                        </PrimaryButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>