<template>
    <div
        class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden"
    >
        <div class="flex items-center p-4">
            <img
                class="w-10 h-10 rounded-full"
                :src="postData.profileImage"
                alt="Profile picture"
            />
            <div class="ml-3">
                <p class="text-sm font-semibold ml-2">
                    {{ postData.user.name }}
                </p>
                <!-- <p class="text-xs text-gray-500">{{ postData.location }}</p> -->
            </div>
        </div>

        <div class="post-image">
            <img
                class="w-full"
                :src="`/storage/images/posts/${postData.images[0].image}`"
                alt="Post image"
            />
            <!-- {{ postData.images[0].image }} -->
        </div>

        <div class="p-4">
            <div class="flex flex-row mb-2">
                <Icon
                    icon="mdi:like-outline"
                    :ssr="true"
                    class="text-2xl mr-2"
                />
                <Icon
                    @click="$emit('detailPost', postData.id)"
                    icon="iconamoon:comment"
                    :ssr="true"
                    class="text-2xl mr-2 cursor-pointer"
                />
            </div>
            <!-- <p class="text-sm font-semibold">{{ postData.likes }} likes</p> -->
            <p class="text-sm">
                <span class="font-semibold">{{ postData.username }}</span>
                {{ postData.content }}
            </p>

            <div class="my-2"><hr /></div>

            <p class="text-sm text-gray-500">Comments</p>
            <div v-if="postData.comments && postData.comments.length > 0">
                <div class="flex space-x-3">
                    <p class="font-extrabold">
                        {{ postData.comments[0].user.name }}
                    </p>
                    <p>{{ postData.comments[0].content }}</p>
                </div>
            </div>
            <!-- <p v-else>No comments available.</p> -->
            <p class="text-xs text-gray-500">{{ postData.timeAgo }}</p>

            <a
                class="hover:cursor-pointer text-xs mt-2 text-gray-700"
                @click="$emit('detailPost', postData.id)"
            >
                View All Comments
            </a>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import { toRefs } from "vue";
import { defineProps } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    postData: {
        type: Object,
        required: true,
    },
});

const { postData } = toRefs(props);
</script>

<style scoped>
.post-image img {
    object-fit: cover;
}
</style>
