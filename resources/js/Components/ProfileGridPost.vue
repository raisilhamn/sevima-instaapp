<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 gap-4">
        <div
            v-for="(post, index) in posts"
            :key="index"
            class="border rounded-xl shadow-lg"
            @click="$emit('detailPost', post.id)"
        >
            <img
                :src="post.image"
                :alt="`Post ${index + 1}`"
                class="hover:cursor-pointer w-full h-auto rounded-lg object-cover max-h-64 min-h-64"
            />
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    posts: {
        type: Array,
        required: true,
        default: () => [],
    },
});
</script>
