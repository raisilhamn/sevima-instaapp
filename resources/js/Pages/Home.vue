<script setup>
import Post from "@/Components/Post.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";

const props = usePage().props;
const userEmail = props.auth.user ? props.auth.user.email : "Guest";
const postData = ref({
    username: "john_doe",
    profileImage: "https://picsum.photos/200",
    location: "Pantai Goa Petapa",
    image: "https://picsum.photos/200",
    likes: 120,
    content: "Beautiful sunset at the beach 🌅 #nature #peaceful",
    timeAgo: "2 hours ago",
});
</script>
<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <!-- Left Sidebar -->
            <Sidebar />

            <!-- Main Content -->
            <main class="container flex-1 pt-10">
                <Post :postData="postData" />
            </main>

            <!-- Right Sidebar with fixed width -->
            <aside class="sticky top-0 ml-10 pt-10 w-52">
                <nav>
                    <ul class="space-y-4">
                        <div class="flex">
                            <img
                                class="w-10 h-10 rounded-full"
                                :src="postData.profileImage"
                                alt="Profile picture"
                            />
                            <div class="flex my-auto ml-2">
                                <p href="" class="mr-2">
                                    {{ userEmail }}
                                </p>
                            </div>
                        </div>
                    </ul>
                    <div class="mt-5">
                        <div class="text-xs">2024 Sevima InstaApp</div>
                        <div class="text-xs">@ Rais Ilham Nustara</div>
                    </div>
                </nav>
            </aside>
        </div>
    </div>
</template>
