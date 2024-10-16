<script setup>
import Post from "@/Components/Post.vue";
import { ref } from "vue";
import { usePage, Head, useForm, router } from "@inertiajs/vue3";

import Sidebar from "@/Components/Sidebar.vue";
import { Icon } from "@iconify/vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
// PrimaryButton

import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import vueFilePond from "vue-filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
const FilePond = vueFilePond(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType
);

const form = useForm({
    foto: [],
    content: "",
});

function handleFilePondLoad(response) {
    form.foto.push(response);
    return response;
}

function handleFilePondCancle(uniqueId, load) {
    router.delete("/revert/" + uniqueId);
    load();
}

function submit() {
    form.post("/create", {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
<template>
    <div>
        <div class="pl-10 mx-auto flex">
            <!-- Left Sidebar -->
            <Sidebar />

            <!-- Main Content -->
            <main class="container flex-1 pt-10">
                <!-- <Post :postData="postData" /> -->

                <form @submit.prevent="submit">
                    <div
                        class="max-w-2xl min-h-96 mx-auto bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <file-pond v-bind:required="true" name="foto" ref="pond" required class-name="my-pond"
                                label-idle="Drag & Drop your files or <span class='filepond--label-action'>Browse</span>"
                                accepted-file-types="image/*" allow-multiple="true" credits="false" :server="{
                                    url: '',
                                    process: {
                                        url: '/upload',
                                        method: 'POST',
                                        onload: handleFilePondLoad,
                                    },
                                    revert: handleFilePondCancle,
                                    headers: {
                                        'X-CSRF-TOKEN': $page.props.csrf_token,
                                    },
                                }" />
                        </div>
                        <div>
                            <div class="p-5">
                                <p class="text-xl font-bold">Caption</p>
                                <textarea id="message" v-model="form.content" rows="4"
                                    class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500"
                                    placeholder="Caption Maksimal 2.200 Karakter ">
                                </textarea>

                                <PrimaryButton class="mt-5 w-full flex justify-center items-center" type="submit">
                                    Create
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </form>
            </main>

            <!-- Right Sidebar with fixed width -->
            <aside class="sticky top-0 ml-10 pt-10 w-52">
                <nav>
                    <!-- <ul class="space-y-4">
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
                    </ul> -->
                    <div class="mt-5">
                        <div class="text-xs">2024 Sevima InstaApp</div>
                        <div class="text-xs">@ Rais Ilham Nustara</div>
                    </div>
                </nav>
            </aside>
        </div>
    </div>
</template>
