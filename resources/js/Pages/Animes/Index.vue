<script setup lang="ts">
import { ref, computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import axios from "axios";

interface Anime {
    id: number;
    title: string;
    genre_name: string;
    path: string;
    watched: boolean; // 真偽値を使用
}

interface User {
    id: number;
}

const props = defineProps<{
    animes: Anime[];
    user: User; // ユーザー情報を受け取る
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

const updateWatched = async (anime: Anime) => {
    try {
        anime.watched = !anime.watched; // ローカル状態を先に更新
        await axios.post("/api/anime-user/update", {
            anime_id: anime.id,
            watched: anime.watched,
            user_id: props.user.id, // ユーザーIDを含める
        });
        console.log("視聴状況が更新されました");
    } catch (error) {
        anime.watched = !anime.watched; // エラー時に状態を元に戻す
        console.error("視聴状況の更新に失敗しました", error);
    }
};
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
                                <div class="pl-4">
                                    <button
                                        @click="updateWatched(anime)"
                                        class="text-xl"
                                    >
                                        <i
                                            v-if="anime.watched"
                                            class="fas fa-eye text-green-500"
                                        ></i>
                                        <i
                                            v-else
                                            class="far fa-eye-slash text-gray-500"
                                        ></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
