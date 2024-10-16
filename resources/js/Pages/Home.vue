<script setup>
import Post from "@/Components/Post.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";
import { Head, router } from "@inertiajs/vue3";

const props = defineProps({
    posts: {
        type: Object,
        required: true,
    },
});

const detailPost = (id) => {
    router.get(route("post.show", { id: id }));
};

const updateLike = (event) => {
    const { id, liked, likeCount } = event;
    const post = props.posts.find(post => post.id === id);
    if (post) {
        post.liked = liked;
        post.like_count = likeCount;
    }
};
</script>

<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <Sidebar />
            <main class="container flex-1 pt-10">
                <div>
                    <div v-for="post in posts" :key="post.id" class="mb-4">
                        <Post :postData="post" :liked="post.liked" :likeCount="post.like_count" @detailPost="detailPost"
                            @updateLike="updateLike" />
                    </div>
                </div>
            </main>
            <aside class="h-screen sticky top-0 ml-10 pt-10 w-52">
                <nav>
                    <div class="mt-5">
                        <div class="text-xs">2024 Sevima InstaApp</div>
                        <div class="text-xs">@ Rais Ilham Nustara</div>
                    </div>
                </nav>
            </aside>
        </div>
    </div>
</template>