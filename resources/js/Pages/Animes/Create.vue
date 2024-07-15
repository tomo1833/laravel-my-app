<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonQuill from "@/Components/Atoms/CommonQuill.vue";
import CommonTitle from "@/Components/Atoms/CommonTitle.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";

import FormText from "@/Components/Molecules/FormText.vue";
import FormFileInput from "@/Components/Molecules/FormFileInput.vue";
import FormSelect from "@/Components/Molecules/FormSelect.vue";

interface Option {
    value: string | number;
    label: string;
}
const props = defineProps({
    animeGenresList: Array<Option>,
    musicList: Array<Option>,
    broadcastPeriodList: Array<Option>,    
});

/**
 * フォームの初期値を設定し、送信時の処理を定義
 */
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

/**
 * ファイルが選択されたときの処理
 * @param {File} file - 選択されたファイル
 */
const handleFileChange = (file: File) => {
    form.image = file;
};

/**
 * フォームを送信する処理
 */
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
                        <CommonBackLink routePath="anime.index" />
                    </div>

                    <CommonTitle title="アニメ" />

                    <FormText
                        label="タイトル"
                        name="title"
                        v-model:modelValue="form.title"
                        :error="form.invalid('title') ? form.errors.title : ''"
                    />

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

                    <FormFileInput
                        label="画像"
                        :error="form.invalid('image') ? form.errors.image : ''"
                        :onFileChange="handleFileChange"
                    />

                    <FormSelect
                        label="ジャンル"
                        name="genre"
                        v-model:modelValue="form.genre"
                        :options="animeGenresList"
                        :error="form.invalid('genre') ? form.errors.genre : ''"
                    />

                    <FormSelect
                        label="放映年期"
                        name="broadcast_period"
                        v-model:modelValue="form.broadcast_period"
                        :options="broadcastPeriodList"
                        :error="form.invalid('broadcast_period') ? form.errors.broadcast_period : ''"
                    />

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

                    <FormSelect
                        label="シーズン1:OP"
                        name="season_1_opening"
                        v-model:modelValue="form.season_1_opening"
                        :options="musicList"
                        :error="
                            form.invalid('season_1_opening')
                                ? form.errors.season_1_opening
                                : ''
                        "
                    />

                    <FormSelect
                        label="シーズン1:ED"
                        name="season_1_ending"
                        v-model:modelValue="form.season_1_ending"
                        :options="musicList"
                        :error="
                            form.invalid('season_1_ending')
                                ? form.errors.season_1_ending
                                : ''
                        "
                    />

                    <FormSelect
                        label="シーズン2:OP"
                        name="season_2_opening"
                        v-model:modelValue="form.season_2_opening"
                        :options="musicList"
                        :error="
                            form.invalid('season_2_opening')
                                ? form.errors.season_2_opening
                                : ''
                        "
                    />

                    <FormSelect
                        label="シーズン2:ED"
                        name="season_2_ending"
                        v-model:modelValue="form.season_2_ending"
                        :options="musicList"
                        :error="
                            form.invalid('season_2_ending')
                                ? form.errors.season_2_ending
                                : ''
                        "
                    />

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
