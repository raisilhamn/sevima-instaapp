<template>
    <div class="flex flex-col items-center mb-8">
        <img
            :src="profileData.profileImage"
            alt="Profile Picture"
            class="w-24 h-24 rounded-full mb-4"
        />
        <h2 class="text-xl font-semibold">{{ profileData.username }}</h2>
        <p class="text-gray-600 text-center whitespace-pre-line">
            {{ profileData.bio }}
        </p>
    </div>
</template>

<script setup>
const props = defineProps({
    profileData: {
        type: Object,
        required: true,
        default: () => ({
            profileImage: "",
            username: "",
            bio: "",
        }),
    },
});
</script>
