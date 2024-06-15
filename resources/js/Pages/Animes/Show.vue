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
            <div class="container sm:px-1 px-5 py-8 mx-auto bg-white h-full">
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
                    <div class="flex items-center justify-center">
                        <img
                            :src="`/storage/${props.anime.path}`"
                            alt="props.anime.title"
                            class="w-96"
                        />
                    </div>

                    <CommonArea :body="props.anime.body" />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
