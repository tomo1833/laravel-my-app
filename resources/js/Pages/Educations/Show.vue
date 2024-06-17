<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    education: Object,
});
</script>

<template>
    <Head title="詳細" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-4 relative h-[calc(100vh-68px)]"
        >
            <div
                class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
            >
                <div class="px-4">
                    <CommonBackLink routePath="education.index" />
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.education.title }}
                    </h1>
                    <CommonArea :body="props.education.body_html" />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
