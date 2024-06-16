<script setup lang="ts">
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonQuill from "@/Components/Atoms/CommonQuill.vue";
import FormText from "@/Components/Molecuels/FormText.vue";

const imageUrl = ref<string | null>(null);
const selectedFile = ref<File | null>(null);

const form = useForm("post", "/anime", {
    id: null,
    title: null,
    title_kana: null,
    image: null,
    genre: null,
    season_1_opening: null,
    season_1_ending: null,
    season_2_opening: null,
    season_2_ending: null,
    body: null,
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
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
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
                        <FormText
                            label="タイトル"
                            name="title"
                            v-model:modelValue="form.title"
                            :error="
                                form.invalid('title') ? form.errors.title : ''
                            "
                        />
                    </div>

                    <div class="mb-4">
                        <FormText
                            label="タイトルカナ"
                            name="title_kana"
                            v-model:modelValue="form.title_kana"
                            :error="
                                form.invalid('title_kana')
                                    ? form.errors.title_kana
                                    : ''
                            "
                        />
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
                        <FormText
                            label="ジャンル"
                            name="genre"
                            v-model:modelValue="form.genre"
                            :error="
                                form.invalid('genre') ? form.errors.genre : ''
                            "
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">本文</label>
                        <CommonQuill
                            :content="form.body"
                            @update:content="
                                (newContent) => (form.body = newContent)
                            "
                        />
                        <div v-if="form.invalid('body')" class="text-red-500">
                            {{ form.errors.body }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <FormText
                            label="シーズン1:OP"
                            name="season_1_opening"
                            v-model:modelValue="form.season_1_opening"
                            :error="
                                form.invalid('season_1_opening')
                                    ? form.errors.season_1_opening
                                    : ''
                            "
                        />
                    </div>

                    <div class="mb-4">
                        <FormText
                            label="シーズン1:ED"
                            name="season_1_ending"
                            v-model:modelValue="form.season_1_ending"
                            :error="
                                form.invalid('season_1_ending')
                                    ? form.errors.season_1_ending
                                    : ''
                            "
                        />
                    </div>

                    <div class="mb-4">
                        <FormText
                            label="シーズン2:OP"
                            name="season_2_opening"
                            v-model:modelValue="form.season_2_opening"
                            :error="
                                form.invalid('season_2_opening')
                                    ? form.errors.season_2_opening
                                    : ''
                            "
                        />
                    </div>

                    <div class="mb-4">
                        <FormText
                            label="シーズン2:ED"
                            name="season_2_ending"
                            v-model:modelValue="form.season_2_ending"
                            :error="
                                form.invalid('season_2_ending')
                                    ? form.errors.season_2_ending
                                    : ''
                            "
                        />
                    </div>

                    <div class="flex flex-row justify-evenly">
                        <div>
                            <CommonSubmitButton text="登録" />
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
