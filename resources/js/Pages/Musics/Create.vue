<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import { QuillEditor } from "@vueup/vue-quill";

const form = useForm("post", "/music", {
    id: null,
    title: null,
    body: null,
    artist: null,
});

const storeMusic = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="音楽" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeMusic">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        音楽
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
                        <label class="block mb-2">アーティスト</label>
                        <input
                            type="text"
                            name="artist"
                            v-model="form.artist"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('artist')" class="text-red-500">
                            {{ form.errors.artist }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">備考</label>
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
