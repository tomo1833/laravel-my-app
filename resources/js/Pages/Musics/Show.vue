<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    music: Object,
});
</script>

<template>
    <Head title="music" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-2 sm:py-24 relative h-[calc(100vh-68px)]"
        >
            <div class="container px-0 sm:px-5 py-8 mx-auto bg-white">
                <div class="px-4">
                    <CommonLinkButton
                        routePath="music.index"
                        text="戻る"
                        styleType="primary"
                    />
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.music.title }}
                    </h1>
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h2
                        class="sm:text-2xl text-xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.music.artist }}
                    </h2>
                </div>
                <div
                    class="relative w-[256px] h-[144px] sm:w-[640px] sm:h-[360px] 2xl:w-[1280px] 2xl:h-[720px] mx-auto"
                >
                    <iframe
                        class="absolute top-0 left-0 w-full h-full"
                        :src="props.music.youtube_url"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>

                <CommonArea :body="props.music.body" />
            </div>
        </section>
    </AuthenticatedLayout>
</template>
