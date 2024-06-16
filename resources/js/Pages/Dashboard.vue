<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    educationCount: Number,
    animeCount: Number,
    animeUserCount: Number,
    musicCount: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1
                                    class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                                >
                                    お知らせ
                                </h1>
                                <p
                                    class="lg:w-2/3 mx-auto leading-relaxed text-base"
                                ></p>

                                <div
                                    class="flex flex-wrap m-4 text-center justify-between"
                                >
                                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                        <div
                                            class="border-2 border-gray-200 px-4 py-6 rounded-lg"
                                        >
                                            <h2
                                                class="title-font font-medium text-3xl text-gray-900"
                                            >
                                                {{ educationCount }} 件
                                            </h2>
                                            <p class="leading-relaxed">
                                                教育関連
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                        <div
                                            class="border-2 border-gray-200 px-4 py-6 rounded-lg"
                                        >
                                            <h2
                                                class="title-font font-medium text-3xl text-gray-900"
                                            >
                                                {{ animeUserCount }} /
                                                {{ animeCount }} 件
                                            </h2>
                                            <p class="leading-relaxed">
                                                アニメ
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                        <div
                                            class="border-2 border-gray-200 px-4 py-6 rounded-lg"
                                        >
                                            <h2
                                                class="title-font font-medium text-3xl text-gray-900"
                                            >
                                                {{ musicCount }} 件
                                            </h2>
                                            <p class="leading-relaxed">音楽</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
