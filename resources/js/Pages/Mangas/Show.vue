<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    manga: Object,
});
</script>

<template>
    <Head title="manga" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-24 relative h-[calc(100vh-68px)]"
        >
            <div
                class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
            >
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.manga.title }}
                    </h1>
                </div>

                <div
                    class="p-8 bg-gray-100 grow h-full overflow-y-auto"
                    v-html="props.manga.body"
                ></div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
