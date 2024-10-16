<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <!-- <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link> -->
        </div>

        <div class="flex w-full justify-center items-center">
            <!-- First column -->
            <div class="">
                <!-- load image asset -->
                <img src="../../../public/images/instagram.png" alt="Logo" />
            </div>
            <!-- Second column -->
            <div
                class="flex-grow max-w-sm border p-10 pt-20 pb-10 rounded-xl shadow-sm"
            >
                <img src="../../../public/images/Sevima-logo.png" alt="Logo" />

                <slot />
            </div>
        </div>
    </div>
</template>
