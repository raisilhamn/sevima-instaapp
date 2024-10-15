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
                <p class="text-sm font-semibold">{{ postData.username }}</p>
                <!-- <p class="text-xs text-gray-500">{{ postData.location }}</p> -->
            </div>
        </div>

        <div class="post-image">
            <img class="w-full" :src="postData.image" alt="Post image" />
        </div>

        <div class="p-4">
            <div class="flex flex-row mb-2">
                <Icon
                    icon="mdi:like-outline"
                    :ssr="true"
                    class="text-2xl mr-2"
                />
                <Icon
                    icon="iconamoon:comment"
                    :ssr="true"
                    class="text-2xl mr-2"
                />
            </div>
            <p class="text-sm font-semibold">{{ postData.likes }} likes</p>
            <p class="text-sm">
                <span class="font-semibold">{{ postData.username }}</span>
                {{ postData.caption }}
            </p>
            <p class="text-xs text-gray-500">{{ postData.timeAgo }}</p>

            <p class="text-xs mt-2 text-gray-700">View All Comments</p>
        </div>
    </div>
</template>

<script setup>
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
