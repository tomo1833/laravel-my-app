<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";

const props = defineProps({
    manga: Object,
});

const form = useForm("put", "/manga/" + props.manga.id, {
    id: props.manga.id,
    title: props.manga.title,
    body: props.manga.body,
});

const updateManga = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteManga = (id) => {
    Inertia.delete(route("manga.destroy", { manga: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="漫画" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateManga">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="flex flex-col text-center w-full mb-12 h-full">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            漫画
                        </h1>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2"></label>
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
                        <label class="block mb-2"></label>
                        <input
                            type="text"
                            name="body"
                            v-model="form.body"
                            class="p-2 border rounded w-full"
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
                            @click="deleteManga(form.id)"
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
