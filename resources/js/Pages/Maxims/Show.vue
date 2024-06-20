<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    maxim: Object,
});
</script>

<template>
    <Head title="maxim" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-24 relative h-[calc(100vh-68px)]"
        >
            <div class="container px-5 py-8 mx-auto bg-white">
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.maxim.title }}
                    </h1>
                </div>

                <div
                    class="p-8 bg-gray-100 grow h-full overflow-y-auto"
                    v-html="props.maxim.body"
                ></div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
