<script setup lang="ts">
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    anime: Object,
});

const imageUrl = ref<string | null>(
    props.anime.path ? `/storage/${props.anime.path}` : null,
);
const selectedFile = ref<File | null>(null);

const form = useForm("put", "/anime/" + props.anime.id, {
    id: props.anime.id,
    title: props.anime.title,
    body: props.anime.body,
    path: props.anime.path,
    image: null,
});

const handleFileChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0] || null;
    if (file) {
        selectedFile.value = file;
        imageUrl.value = URL.createObjectURL(file);
        form.image = file;
    } else {
        selectedFile.value = null;
        imageUrl.value = null;
        form.image = null;
    }
};

const updateAnime = () => {
    const formData = new FormData();
    formData.append("_method", "PUT"); // PUTメソッドを指定
    formData.append("title", form.title);
    formData.append("body", form.body);
    if (selectedFile.value) {
        formData.append("image", selectedFile.value);
    }

    Inertia.post("/anime/" + props.anime.id, formData, {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteAnime = (id) => {
    Inertia.delete(route("anime.destroy", { anime: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="アニメ" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateAnime">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="pb-10">
                        <CommonLinkButton
                            routePath="anime.index"
                            text="戻る"
                            styleType="primary"
                        />
                    </div>
                    <div class="flex flex-col text-center w-full mb-12 h-full">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            アニメ
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
                        <label class="block mb-2">画像</label>
                        <input
                            type="file"
                            @change="handleFileChange"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('image')" class="text-red-500">
                            {{ form.errors.image }}
                        </div>
                        <img v-if="imageUrl" :src="imageUrl" class="mt-4" />
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
                    <div class="flex flex-row">
                        <button
                            type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            更新
                        </button>
                        <button
                            type="button"
                            @click="deleteAnime(form.id)"
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
