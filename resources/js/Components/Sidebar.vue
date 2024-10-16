<script setup>
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <aside class="h-screen sticky top-0 mr-10 pt-10">
        <nav>
            <ul class="space-y-4">
                <Link :href="route('home')"
                    ><img
                        class="w-52"
                        src="../../../public/images/Sevima-logo.png"
                        alt="Logo"
                /></Link>

                <li>
                    <Link class="flex" :href="route('home')">
                        <Icon
                            icon="mdi:home"
                            :ssr="true"
                            class="text-3xl mr-2"
                        />
                        <div class="flex my-auto">
                            <p href="" class="text-xl mr-2 font-extrabold">
                                Home
                            </p>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link class="flex" :href="route('create.post')">
                        <Icon
                            icon="material-symbols-light:add-box-outline"
                            :ssr="true"
                            class="text-3xl mr-2"
                        />
                        <div class="flex my-auto">
                            <p href="" class="text-xl mr-2 font-extrabold">
                                Create
                            </p>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link class="flex" :href="route('profile')">
                        <Icon
                            icon="mdi:account"
                            :ssr="true"
                            class="text-3xl mr-2"
                        />
                        <div class="flex my-auto">
                            <p href="" class="text-xl mr-2 font-extrabold">
                                Profile
                            </p>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link
                        class="flex"
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        <Icon
                            icon="mdi:logout"
                            :ssr="true"
                            class="text-3xl ml-1 mr-2"
                        />
                        <div class="flex my-auto">
                            <p href="" class="text-xl mr-2 font-extrabold">
                                Logout
                            </p>
                        </div>
                    </Link>
                </li>
            </ul>
        </nav>
    </aside>
</template>
