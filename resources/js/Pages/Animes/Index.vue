<script setup lang="ts">
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

interface Anime {
    id: number;
    title: string;
    genre_name: string;
    path: string;
}

const props = defineProps<{
    animes: Anime[];
}>();

const searchQuery = ref<string>("");

const filteredAnimes = computed(() => {
    if (!searchQuery.value) {
        return props.animes;
    }
    return props.animes.filter((anime) => {
        const title = anime.title.toLowerCase();
        const query = searchQuery.value.toLowerCase();
        return title.includes(query);
    });
});
</script>

<template>
    <Head title="アニメ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                アニメ
            </h2>
        </template>

        <FlashMessage
            v-if="$page.props.flash.status"
            :status="$page.props.flash.status"
            :message="$page.props.flash.message"
        />

        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div class="px-4">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="検索..."
                    class="p-2 border border-gray-300 rounded"
                />
            </div>
            <div class="p-4 2xl:px-64">
                <CommonLinkButton
                    routePath="anime.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>
        <div class="mx-0 sm:mx-2 2xl:mx-4 my-1">
            <div class="overflow-y-auto h-[calc(100vh-250px)] flex flex-wrap">
                <template v-for="anime in filteredAnimes" :key="anime.id">
                    <div
                        class="relative flex flex-col mx-2 mb-4 h-96 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-64"
                    >
                        <div
                            class="relative h-32 mx-auto mt-4 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl"
                        >
                            <img
                                :src="`/storage/${anime.path}`"
                                :alt="anime.title"
                                class="object-cover w-full h-full"
                            />
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h5
                                class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900"
                            >
                                {{ anime.title }}
                            </h5>
                            <p
                                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit mb-2"
                            ></p>
                            <div class="mt-auto">
                                {{ anime.genre_name }}
                            </div>
                            <div class="mt-auto flex space-x-2">
                                <CommonLinkButton
                                    routePath="anime.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ anime: anime.id }"
                                />
                                <CommonLinkButton
                                    routePath="anime.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ anime: anime.id }"
                                />
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
