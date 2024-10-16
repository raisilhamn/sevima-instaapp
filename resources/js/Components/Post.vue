<template>
    <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
        <div class="cursor-pointer flex items-center p-4" @click="$emit('detailProfile', postData.user.id)">
            <img class="w-10 h-10 rounded-full" :src="`https://picsum.photos/id/${postData.user.id}/200/300`" />
            <div class="ml-3">
                <p class="text-sm font-semibold ml-2">
                    {{ postData.user.name }}
                </p>

            </div>
            <p class="text-sm text-gray-500 ml-2">
                {{ formatTimeAgo(new Date(postData.created_at)) }}
                <!-- {{ postData.user.name }} -->
            </p>
        </div>

        <Carousel :wrap-around="false">
            <Slide v-for="(index) in postData.images" :key="index">
                <div class="">
                    <img :src="`/storage/images/posts/${index.image}`" class="w-full" />
                </div>
            </Slide>
            <template #addons>
                <Navigation />
            </template>
        </Carousel>

        <div class="p-4">
            <div class="flex flex-row mb-2">
                <Icon :icon="isLiked ? 'mdi:like' : 'mdi:like-outline'" :ssr="true" class="text-2xl mr-2 cursor-pointer"
                    @click="toggleLike" />
                <Icon @click="$emit('detailPost', postData.id)" icon="iconamoon:comment" :ssr="true"
                    class="text-2xl mr-2 cursor-pointer" />
            </div>
            <p class="text-sm font-semibold">{{ currentLikeCount }} likes</p>
            <p class="text-sm">
                <span class="font-semibold">{{ postData.username }}</span>
                {{ postData.content }}
            </p>

            <div class="my-2">
                <hr />
            </div>

            <p class="text-sm text-gray-500">Comments</p>
            <div v-if="postData.comments && postData.comments.length > 0">
                <div class="flex space-x-3">
                    <p class="font-extrabold">
                        {{ postData.comments[0].user.name }}
                    </p>
                    <p>{{ postData.comments[0].content }}</p>
                    <p class="text-gray-400">
                        {{ formatTimeAgo(new Date(postData.comments[0].created_at)) }}
                    </p>
                </div>
            </div>
            <p class="text-xs text-gray-500">{{ postData.timeAgo }}</p>

            <a class="hover:cursor-pointer text-xs mt-2 text-gray-700" @click="$emit('detailPost', postData.id)">
                View All Comments
            </a>
        </div>
    </div>
</template>

<script setup>
import { Carousel, Navigation, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";

import { formatTimeAgo } from '@vueuse/core';
import { ref, toRefs, watch } from "vue";
import { defineProps } from "vue";
import { Icon } from "@iconify/vue";
import axios from "axios";

const props = defineProps({
    postData: {
        type: Object,
        required: true,
    },
    liked: {
        type: Boolean,
        required: true,
    },
    likeCount: {
        type: Number,
        required: true,
    },
});

const { postData, liked, likeCount } = toRefs(props);
const isLiked = ref(liked.value);
const currentLikeCount = ref(likeCount.value);

watch(liked, (newVal) => {
    isLiked.value = newVal;
});

watch(likeCount, (newVal) => {
    currentLikeCount.value = newVal;
});

const toggleLike = async () => {
    try {
        if (isLiked.value) {
            await axios.post(`/posts/${postData.value.id}/unlike`);
            currentLikeCount.value--;
        } else {
            await axios.post(`/posts/${postData.value.id}/like`);
            currentLikeCount.value++;
        }
        isLiked.value = !isLiked.value;
        // Emit an event to notify the parent component
        emit('updateLike', { id: postData.value.id, liked: isLiked.value, likeCount: currentLikeCount.value });
    } catch (error) {
        console.error("Error toggling like:", error);
    }
};
</script>

<style scoped>
.post-image img {
    object-fit: cover;
}



.carousel__slide {
    padding: 10px;
}

.carousel__prev,
.carousel__next {
    box-sizing: content-box;
    color: gray;
    border-radius: 100%;
    background-color: white;
    border: 1px solid gray;
    padding: 10px;
    margin-left: 1vw;
    margin-right: 1vw;
    max-width: 20px;
    max-height: 20px;
    /* transition: transform 0.5s ease; */
}
</style>