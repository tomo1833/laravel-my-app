<script setup lang="ts">
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    musics: Array<object>,
});

const searchQuery = ref<string>("");

const filteredMusics = computed(() => {
    if (!searchQuery.value) {
        return props.musics;
    }
    return props.musics.filter((music) => {
        const title = music.title ? music.title.toLowerCase() : "";
        const artist = music.artist ? music.artist.toLowerCase() : "";
        const query = searchQuery.value.toLowerCase();
        return title.includes(query) || artist.includes(query);
    });
});
</script>

<template>
    <Head title="音楽" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                音楽
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
                    routePath="music.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>
        <div class="bg-[#FFFFFF] mx-0 sm:mx-2 2xl:mx-4 my-2">
            <div class="overflow-y-auto h-[calc(100vh-250px)]">
                <table
                    class="table-auto w-full text-left whitespace-no-wrap text-gray-500"
                >
                    <thead class="text-xs text-gray-700 uppercase bg-[#F4F4F4]">
                        <tr>
                            <th scope="col" class="py-3 px-2 sm:px-4 2xl:px-6">
                                タイトル
                            </th>
                            <th scope="col" class="py-3 px-2 sm:px-4 2xl:px-6">
                                アーティスト
                            </th>
                            <th
                                scope="col"
                                class="py-3 px-2 sm:px-4 2xl:px-6"
                            ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="music in filteredMusics"
                            :key="music.id"
                            class="bg-white border-b"
                        >
                            <td class="py-4 px-2 sm:px-4 2xl:px-6">
                                {{ music.title }}
                            </td>
                            <td class="py-4 px-2 sm:px-4 2xl:px-6">
                                {{ music.artist }}
                            </td>
                            <td class="py-4 px-2 sm:px-4 2xl:px-6">
                                <CommonLinkButton
                                    routePath="music.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ music: music.id }"
                                />
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <CommonLinkButton
                                    routePath="music.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ music: music.id }"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
