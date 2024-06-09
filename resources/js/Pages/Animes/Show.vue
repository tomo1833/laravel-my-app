<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";

const props = defineProps({
    anime: Object,
});
</script>

<template>
    <Head title="anime" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-24 relative h-[calc(100vh-68px)]"
        >
            <div class="container px-5 py-8 mx-auto bg-white h-full">
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.anime.title }}
                    </h1>
                    <img :src="`/storage/${props.anime.path}`" alt="props.anime.title">
                    <CommonArea :body="props.anime.body" />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
