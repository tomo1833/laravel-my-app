<script setup lang="ts">
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const imageUrl = ref<string | null>(null);
const selectedFile = ref<File | null>(null);

const form = useForm("post", "/anime", {
    id: null,
    title: null,
    body: null,
    image: null,
});

const handleFileChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0] || null;
    if (file) {
        selectedFile.value = file;
        imageUrl.value = URL.createObjectURL(file);
        form.image = file; // 画像ファイルをフォームデータに追加
    } else {
        selectedFile.value = null;
        imageUrl.value = null;
    }
};

const storeAnime = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="アニメ" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeAnime">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="pb-10">
                        <CommonLinkButton
                            routePath="anime.index"
                            text="戻る"
                            styleType="primary"
                        />
                    </div>
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 text-center"
                    >
                        アニメ
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

                    <CommonSubmitButton text="登録" />
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
