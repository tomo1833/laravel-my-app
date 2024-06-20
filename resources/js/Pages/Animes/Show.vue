<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonShowTitle from "@/Components/Atoms/CommonShowTitle.vue";

const props = defineProps({
    anime: Object,
});
</script>

<template>
    <Head title="詳細" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-2 sm:py-4 relative h-[calc(100vh-68px)] overflow-y-auto"
        >
            <div
                class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
            >
                <div class="px-4">
                    <CommonBackLink routePath="anime.index" />
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <CommonShowTitle :title="props.anime.title" />
                    <div class="flex items-center justify-center mb-4 md:mb-0">
                        <img
                            :src="`/storage/${props.anime.path}`"
                            :alt="props.anime.title"
                            class="w-full max-w-[426px] object-cover"
                        />
                    </div>
                    <div
                        class="flex flex-col md:flex-row justify-evenly items-center md:items-start"
                    >
                        <div
                            v-if="
                                props.anime.season_1_opening_title ||
                                props.anime.season_2_opening_title
                            "
                            class="flex flex-col md:flex-row md:justify-evenly w-full"
                        >
                            <div
                                v-if="props.anime.season_1_opening_title"
                                class="flex flex-col items-center mb-4 md:mb-0 md:w-1/2 px-2"
                            >
                                <h3 class="text-lg mb-2 text-gray-900">
                                    1期OPタイトル:
                                    {{ props.anime.season_1_opening_title }}
                                </h3>
                                <h3 class="text-lg mb-2 text-gray-900">
                                    1期OPアーティスト:
                                    {{ props.anime.season_1_opening_artist }}
                                </h3>
                                <div
                                    class="relative w-full max-w-[426px] h-[240px] mx-auto"
                                >
                                    <iframe
                                        class="absolute top-0 left-0 w-full h-full"
                                        :src="
                                            props.anime
                                                .season_1_opening_youtube_url
                                        "
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                            <div
                                v-if="props.anime.season_1_ending_title"
                                class="flex flex-col items-center mb-4 md:mb-0 md:w-1/2 px-2"
                            >
                                <h3 class="text-lg mb-2 text-gray-900">
                                    1期EDタイトル:
                                    {{ props.anime.season_1_ending_title }}
                                </h3>
                                <h3 class="text-lg mb-2 text-gray-900">
                                    1期EDアーティスト:
                                    {{ props.anime.season_1_ending_artist }}
                                </h3>
                                <div
                                    class="relative w-full max-w-[426px] h-[240px] mx-auto"
                                >
                                    <iframe
                                        class="absolute top-0 left-0 w-full h-full"
                                        :src="
                                            props.anime
                                                .season_1_ending_youtube_url
                                        "
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="
                                props.anime.season_2_opening_title ||
                                props.anime.season_2_opening_title
                            "
                            class="flex flex-col md:flex-row md:justify-evenly w-full"
                        >
                            <div
                                v-if="props.anime.season_2_opening_title"
                                class="flex flex-col items-center mb-4 md:mb-0 md:w-1/2 px-2"
                            >
                                <h3 class="text-lg mb-2 text-gray-900">
                                    2期OPタイトル:
                                    {{ props.anime.season_2_opening_title }}
                                </h3>
                                <h3 class="text-lg mb-2 text-gray-900">
                                    2期OPアーティスト:
                                    {{ props.anime.season_2_opening_artist }}
                                </h3>
                                <div
                                    class="relative w-full max-w-[426px] h-[240px] mx-auto"
                                >
                                    <iframe
                                        class="absolute top-0 left-0 w-full h-full"
                                        :src="
                                            props.anime
                                                .season_2_opening_youtube_url
                                        "
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                            <div
                                v-if="props.anime.season_2_ending_title"
                                class="flex flex-col items-center mb-4 md:mb-0 md:w-1/2 px-2"
                            >
                                <h3 class="text-lg mb-2 text-gray-900">
                                    2期EDタイトル:
                                    {{ props.anime.season_2_ending_title }}
                                </h3>
                                <h3 class="text-lg mb-2 text-gray-900">
                                    2期EDアーティスト:
                                    {{ props.anime.season_2_ending_artist }}
                                </h3>
                                <div
                                    class="relative w-full max-w-[426px] h-[240px] mx-auto"
                                >
                                    <iframe
                                        class="absolute top-0 left-0 w-full h-full"
                                        :src="
                                            props.anime
                                                .season_2_ending_youtube_url
                                        "
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2
                        class="sm:text-xl text-2xl py-8 text-left text-gray-900 p-[20px]"
                    >
                        ジャンル : {{ props.anime.genre_name }}
                    </h2>
                </div>
                <CommonArea :body="props.anime.body" />
            </div>
        </section>
    </AuthenticatedLayout>
</template>
