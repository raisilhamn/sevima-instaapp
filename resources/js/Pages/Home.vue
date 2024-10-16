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
</script>

<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <Sidebar />
            <main class="container flex-1 pt-10">
                <div>
                    <div v-for="post in posts" :key="post.id" class="mb-4">
                        <Post :postData="post" :liked="post.liked" @detailPost="detailPost" />
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
