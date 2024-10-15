<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import Post from "@/Components/Post.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const props = usePage().props;
const userEmail = props.auth.user ? props.auth.user.email : "Guest";
const postData = ref({
    username: "john_doe",
    profileImage: "https://picsum.photos/200",
    location: "Pantai Goa Petapa",
    image: "https://picsum.photos/200",
    likes: 120,
    caption: "Beautiful sunset at the beach 🌅 #nature #peaceful",
    timeAgo: "2 hours ago",
});
</script>
<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <!-- Left Sidebar -->
            <aside class="h-screen sticky top-0 mr-10 pt-10">
                <nav>
                    <ul class="space-y-4">
                        <img
                            class="w-52"
                            src="../../../public/images/Sevima-logo.png"
                            alt="Logo"
                        />

                        <li>
                            <Link class="flex" :href="route('home')">
                                <Icon
                                    icon="mdi:home"
                                    :ssr="true"
                                    class="text-3xl mr-2"
                                />
                                <div class="flex my-auto">
                                    <p
                                        href=""
                                        class="text-xl mr-2 font-extrabold"
                                    >
                                        Home
                                    </p>
                                </div>
                            </Link>
                        </li>
                        <li>
                            <Link class="flex" :href="route('dashboard')">
                                <Icon
                                    icon="material-symbols-light:add-box-outline"
                                    :ssr="true"
                                    class="text-3xl mr-2"
                                />
                                <div class="flex my-auto">
                                    <p
                                        href=""
                                        class="text-xl mr-2 font-extrabold"
                                    >
                                        Create
                                    </p>
                                </div>
                            </Link>
                        </li>
                        <li>
                            <Link class="flex" :href="route('dashboard')">
                                <Icon
                                    icon="mdi:account"
                                    :ssr="true"
                                    class="text-3xl mr-2"
                                />
                                <div class="flex my-auto">
                                    <p
                                        href=""
                                        class="text-xl mr-2 font-extrabold"
                                    >
                                        Profile
                                    </p>
                                </div>
                            </Link>
                        </li>
                        <li>
                            <Link class="flex" :href="route('dashboard')">
                                <Icon
                                    icon="mdi:logout"
                                    :ssr="true"
                                    class="text-3xl ml-1 mr-2"
                                />
                                <div class="flex my-auto">
                                    <p
                                        href=""
                                        class="text-xl mr-2 font-extrabold"
                                    >
                                        Logout
                                    </p>
                                </div>
                            </Link>
                        </li>
                    </ul>
                </nav>
            </aside>

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
