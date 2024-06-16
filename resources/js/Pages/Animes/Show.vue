<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    anime: Object,
});
</script>

<template>
    <Head title="詳細" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-4 relative h-[calc(100vh-68px)]"
        >
            <div
                class="container sm:px-1 px-5 py-8 h-full mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
            >
                <div class="px-4">
                    <CommonLinkButton
                        routePath="anime.index"
                        text="戻る"
                        styleType="primary"
                    />
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.anime.title }}
                    </h1>

                    <div class="flex justify-evenly">
                        <div class="flex items-center justify-center">
                            <img
                                :src="`/storage/${props.anime.path}`"
                                alt="props.anime.title"
                                class="w-[426px]"
                            />
                        </div>
                    <div
                        v-if="
                            props.anime.season_1_opening_title ||
                            props.anime.season_2_opening_title
                        "
                        class="flex flex-col"
                    >
                        <div
                            v-if="props.anime.season_1_opening_title"
                            class="flex flex-row justify-evenly"
                        >
                            <div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        1期OPタイトル:{{
                                            props.anime.season_1_opening_title
                                        }}
                                    </h3>
                                </div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        1期OPアーティスト:{{
                                            props.anime.season_1_opening_artist
                                        }}
                                    </h3>
                                </div>
                                <div
                                    class="relative w-[426px] h-[240px] mx-auto"
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
                            <div class="p-2">
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        1期EDタイトル:{{
                                            props.anime.season_1_ending_title
                                        }}
                                    </h3>
                                </div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        1期EDアーティスト:{{
                                            props.anime.season_1_ending_artist
                                        }}
                                    </h3>
                                </div>
                                <div
                                    class="relative w-[426px] h-[240px] mx-auto"
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
                            v-if="props.anime.season_2_opening_title"
                            class="flex flex-row justify-evenly"
                        >
                            <div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        2期OPタイトル:{{
                                            props.anime.season_2_opening_title
                                        }}
                                    </h3>
                                </div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        2期OPアーティスト:{{
                                            props.anime.season_2_opening_artist
                                        }}
                                    </h3>
                                </div>
                                <div
                                    class="relative w-[426px] h-[240px] mx-auto"
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
                            <div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        2期EDタイトル:{{
                                            props.anime.season_2_endign_title
                                        }}
                                    </h3>
                                </div>
                                <div>
                                    <h3 class="text-lg mb-4 text-gray-900">
                                        2期EDアーティスト:{{
                                            props.anime.season_2_ending_artist
                                        }}
                                    </h3>
                                </div>
                                <div
                                    class="relative w-[426px] h-[240px] mx-auto"
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

                    </div>


                    <h2
                        class="sm:text-xl text-2xl py-8 text-left text-gray-900"
                    >
                        ジャンル : {{ props.anime.genre_name }}
                    </h2>
                    <CommonArea :body="props.anime.body" />

                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
