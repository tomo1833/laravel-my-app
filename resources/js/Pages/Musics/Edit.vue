<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
const props = defineProps({
    music: Object,
});

const form = useForm("put", "/music/" + props.music.id, {
    id: props.music.id,
    title: props.music.title,
    artist: props.music.artist,
    youtube_url: props.music.youtube_url,
    body: props.music.body,
});

const updateMusic = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteMusic = (id) => {
    Inertia.delete(route("music.destroy", { music: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="音楽" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateMusic">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="pb-10">
                        <CommonBackLink routePath="music.index" />
                    </div>
                    <div class="flex flex-col text-center w-full mb-12 h-full">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            音楽
                        </h1>
                    </div>

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
                        <label class="block mb-2">YouTubu URL</label>
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
                    <div class="flex flex-row">
                        <button
                            type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            更新
                        </button>
                        <button
                            type="button"
                            @click="deleteMusic(form.id)"
                            class="mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                        >
                            削除
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
