<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import { QuillEditor } from "@vueup/vue-quill";

const form = useForm("post", "/music", {
    id: null,
    title: null,
    artist: null,
    youtube_url: null,
    body: null,
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
        <section class="text-gray-600 body-font py-4 relative">
            <form @submit.prevent="storeMusic">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="pb-10">
                        <CommonBackLink routePath="music.index" />
                    </div>

                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 text-center"
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
                        <label class="block mb-2">YouTube URL</label>
                        <input
                            type="text"
                            name="youtube_url"
                            v-model="form.youtube_url"
                            class="p-2 border rounded w-full"
                        />
                        <div
                            v-if="form.invalid('youtube_url')"
                            class="text-red-500"
                        >
                            {{ form.errors.youtube_url }}
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
