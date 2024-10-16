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

const detailProfile = (id) => {
    router.get(route("profile.show", { id: id }));
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
                            @detailProfile="detailProfile" @updateLike="updateLike" />
                    </div>
                </div>
            </main>
            <aside class="h-screen sticky top-0 ml-10 pt-10 w-52">
                <nav>
                    <div class="mt-5">

                        <!-- circle profile with username -->
                        <div class="flex items-center mb-5">
                            <img :src="`https://picsum.photos/id/${$page.props.auth.user.id}/200/300`" alt="profile"
                                class="w-12 h-12 rounded-full">
                            <!-- {{ $page.props.auth.user.id }} -->
                            <div class="ml-3">
                                <div class="font-semibold">{{ $page.props.auth.user.name }}</div>
                                <!-- <div class="text-xs">john_doe</div> -->
                            </div>
                        </div>

                        <div class="text-xs">2024 Sevima InstaApp</div>
                        <div class="text-xs">@ Rais Ilham Nustara</div>
                    </div>
                </nav>
            </aside>
        </div>
    </div>
</template>