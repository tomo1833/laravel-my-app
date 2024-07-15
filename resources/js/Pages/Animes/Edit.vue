<script setup lang="ts">
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonDeleteButton from "@/Components/Atoms/CommonDeleteButton.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonQuill from "@/Components/Atoms/CommonQuill.vue";

import CommonTitle from "@/Components/Atoms/CommonTitle.vue";
import FormText from "@/Components/Molecules/FormText.vue";
import FormSelect from "@/Components/Molecules/FormSelect.vue";

interface Option {
    value: string | number;
    label: string;
}

const props = defineProps({
    anime: Object,
    animeGenresList: Array<Option>,
    musicList: Array<Option>,
    broadcastPeriodList: Array<Option>,  
});

const imageUrl = ref<string | null>(
    props.anime.path ? `/storage/${props.anime.path}` : null,
);
const selectedFile = ref<File | null>(null);

const form = useForm("put", "/anime/" + props.anime.id, {
    id: props.anime.id,
    title: props.anime.title,
    title_kana: props.anime.title_kana,
    genre: props.anime.genre,
    broadcast_period: props.anime.broadcast_period,
    body: props.anime.body,
    path: props.anime.path,
    season_1_opening: props.anime.season_1_opening,
    season_1_ending: props.anime.season_1_ending,
    season_2_opening: props.anime.season_2_opening,
    season_2_ending: props.anime.season_2_ending,
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
    formData.append("_method", "PUT");
    formData.append("title", form.title);
    formData.append("title_kana", form.title_kana);
    formData.append("genre", form.genre);
    formData.append("broadcast_period", form.broadcast_period);
    formData.append("season_1_opening", form.season_1_opening);
    formData.append("season_1_ending", form.season_1_ending);
    formData.append("season_2_opening", form.season_2_opening);
    formData.append("season_2_ending", form.season_2_ending);
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
    Inertia.delete(route("anime.destroy", { anime: id }));
};
</script>

<template>
    <Head title="アニメ" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateAnime">
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

                    <FormSelect
                        label="ジャンル"
                        name="genre"
                        v-model:modelValue="form.genre"
                        :options="animeGenresList"
                        :error="form.invalid('genre') ? form.errors.genre : ''"
                    />

                    <FormSelect
                        label="放送年期"
                        name="broadcast_period"
                        v-model:modelValue="form.broadcast_period"
                        :options="broadcastPeriodList"
                        :error="form.invalid('genre') ? form.errors.broadcast_period : ''"
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
                            <CommonSubmitButton text="更新" />
                        </div>
                        <div>
                            <CommonDeleteButton
                                text="削除"
                                @click="deleteAnime(form.id)"
                            />
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
