<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import { QuillEditor } from "@vueup/vue-quill";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const form = useForm("post", "/blog", {
    id: null,
    title: null,
    body: null,
});
const storeBlog = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="ブログ" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeBlog">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="pb-10">
                        <CommonLinkButton
                            routePath="blog.index"
                            text="戻る"
                            styleType="primary"
                        />
                    </div>
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 text-center"
                    >
                        ブログ
                    </h1>
                    <div class="mb-4">
                        <label class="block mb-2">タイトル</label>
                        <input
                            type="text"
                            name="title"
                            v-model="form.title"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('title')" class="text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">本文</label>
                        <QuillEditor
                            theme="snow"
                            v-model:content="form.body"
                            contentType="html"
                        />

                        <div v-if="form.invalid('body')" class="text-red-500">
                            {{ form.errors.body }}
                        </div>
                    </div>
                    <CommonSubmitButton text="登録" />
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
