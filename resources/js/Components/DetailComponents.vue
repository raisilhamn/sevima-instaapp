<template>
    <div
        class="flex max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden"
    >
        <div class="w-1/2 flex overflow-x-scroll space-x-4 p-4 bg-gray-100">
            <div>
                <!-- <img
                    v-for="image in post.images"
                    :key="image.id"
                    :src="`/storage/images/posts/${image.image}`"
                    alt="Post Image"
                    class="w-full object-cover rounded-lg shadow"
                /> -->
                <img
                    :src="`/storage/images/posts/${post.images[0].image}`"
                    alt="Post Image"
                    class="w-full object-cover rounded-lg shadow"
                />
            </div>
        </div>
        <div class="w-1/2 p-4">
            <div class="flex items-center mb-4">
                <img
                    :src="`/storage/images/profiles/${post.profileImage}`"
                    alt="Profile Image"
                    class="w-12 h-12 rounded-full object-cover mr-4"
                />
                <div>
                    <p class="text-gray-800 font-semibold">{{ post.email }}</p>
                    <!-- <p class="text-gray-800 font-semibold"></p> -->
                </div>
            </div>
            <hr class="my-5" />
            <div class="flex items-center mb-4">
                <img
                    :src="`/storage/images/profiles/${post.profileImage}`"
                    alt="Profile Image"
                    class="w-12 h-12 rounded-full object-cover mr-4"
                />
                <div>
                    <p class="text-gray-600">{{ post.content }}</p>
                    <!-- <p class="text-gray-800 font-semibold"></p> -->
                </div>
            </div>
            <hr class="my-5" />
            <!-- comments -->
            <div class="mt-5">
                <h1 class="font-semibold">Comments</h1>
                <div class="mt-5">
                    <!-- <div
                        v-for="comment in comments"
                        :key="comment.id"
                        class="flex items-center space-x-4"
                    >
                        <img
                            :src="`/storage/images/profiles/${comment.profileImage}`"
                            alt="Profile Image"
                            class="w-12 h-12 rounded-full object-cover"
                        />
                        <div>
                            <p class="text-gray-800 font-semibold">{{ comment.email }}</p>
                            <p class="text-gray-600">{{ comment.content }}</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    post: {
        type: Object,
        required: true,
        default: () => ({
            content: "",
            created_at: "",
            updated_at: "",
            images: [],
            profileImage: "",
            email: "",
        }),
    },
    comments: {
        type: Array,
        // required: true,
        default: () => [],
    },
});
</script>
