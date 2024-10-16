<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import Post from "@/Components/Post.vue";
import Sidebar from "@/Components/Sidebar.vue";

import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import ProfileSection from "@/Components/ProfileHeader.vue";
import GridPosts from "@/Components/ProfileGridPost.vue";

const props = defineProps({
    posts: {
        type: Array,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
});

const profileData = {
    profileImage: "https://picsum.photos/200",
    username: "raisilham.jpg",
    bio: "Rais Ilham\nPenting? Email ke rais@hidata.id\nFOSS Enthusiast\n🌐 raisilham.com",
};

const detailPost = (id) => {
    router.get(route("post.show", { id: id }));
};

// Extract the first image from each post, if available
const extractedImages = props.posts
    .map((post) => {
        if (post.images && post.images.length > 0) {
            return {
                id: post.id,
                image: `/storage/images/posts/${post.images[0].image}`,
            };
        } else {
            return null;
        }
    })
    .filter((image) => image !== null);
</script>
<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <Sidebar />
            <main class="container flex-1 pt-10">
                <div class="max-w-5xl mx-auto p-4">
                    <!-- {{ user }} -->
                    <ProfileSection :profileData="user" />
                    <div v-if="extractedImages.length === 0">
                        Tidak ada postingan
                    </div>
                    <GridPosts v-else :posts="extractedImages" @detailPost="detailPost" />
                </div>
            </main>
        </div>
    </div>
</template>
