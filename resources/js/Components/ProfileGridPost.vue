<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 gap-4">
        <div v-for="(post, index) in posts" :key="index" class="post-item">
            <img
                :src="post.image"
                :alt="`Post ${index + 1}`"
                class="hover:cursor-pointer w-full h-auto rounded-lg object-cover"
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

// Log the image URLs for debugging
console.log(props.posts.map((post) => post.image));
</script>
