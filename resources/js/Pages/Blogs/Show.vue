<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    blog: Object,
});
</script>

<template>
    <Head title="blog" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-24 relative h-[calc(100vh-68px)]"
        >
            <div class="container px-5 py-8 mx-auto bg-white">
                <div class="px-4">
                    <CommonLinkButton
                        routePath="blog.index"
                        text="戻る"
                        styleType="primary"
                    />
                </div>
                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.blog.title }}
                    </h1>
                </div>
                <CommonArea :body="props.blog.body" />
            </div>
        </section>
    </AuthenticatedLayout>
</template>
