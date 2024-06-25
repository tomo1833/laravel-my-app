<script setup lang="ts">
import { ref, computed } from "vue";
import { Head } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import axios from "axios";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faSearch } from "@fortawesome/free-solid-svg-icons";

interface Anime {
    id: number;
    title: string;
    genre_name: string;
    path: string;
    watched: boolean;
}

interface User {
    id: number;
}

const props = defineProps<{
    animes: Anime[];
    user: User;
}>();

const searchQuery = ref<string>("");
const watchedFilter = ref<string>("all");

const filteredAnimes = computed(() => {
    return props.animes.filter((anime) => {
        const titleMatch =
            !searchQuery.value ||
            anime.title.toLowerCase().includes(searchQuery.value.toLowerCase());
        const watchedMatch =
            watchedFilter.value === "all" ||
            (watchedFilter.value === "watched" && anime.watched) ||
            (watchedFilter.value === "not_watched" && !anime.watched);

        return titleMatch && watchedMatch;
    });
});

const updateWatched = async (anime: Anime) => {
    try {
        anime.watched = !anime.watched;
        await axios.post("/api/anime-user/update", {
            anime_id: anime.id,
            watched: anime.watched,
            user_id: props.user.id,
        });
        console.log("視聴状況が更新されました");
    } catch (error) {
        anime.watched = !anime.watched;
        console.error("視聴状況の更新に失敗しました", error);
    }
};

const isModalOpen = ref(false);
const toggleModal = () => {
    isModalOpen.value = !isModalOpen.value;
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
            <div class="px-4 flex space-x-4">
                <button
                    @click="toggleModal"
                    class="p-2 border border-gray-300 rounded"
                >
                    <FontAwesomeIcon :icon="faSearch" />
                </button>
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
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 overflow-y-auto h-[calc(100vh-250px)]"
            >
                <template v-for="anime in filteredAnimes" :key="anime.id">
                    <div
                        class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl h-96"
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
                                        <font-awesome-icon
                                            v-if="anime.watched"
                                            icon="eye"
                                            class="text-green-500"
                                        />
                                        <font-awesome-icon
                                            v-else
                                            icon="eye-slash"
                                            class="text-gray-500"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- モーダルウィンドウ -->
        <transition name="fade">
            <div v-if="isModalOpen" class="fixed z-50 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 transition-opacity">
                        <div
                            class="absolute inset-0 bg-gray-500 opacity-75"
                        ></div>
                    </div>
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:text-left"
                                >
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                    >
                                        検索
                                    </h3>
                                    <div class="mt-2">
                                        <input
                                            type="text"
                                            v-model="searchQuery"
                                            placeholder="検索キーワード"
                                            class="w-full p-2 border rounded"
                                        />
                                        <select
                                            v-model="watchedFilter"
                                            class="w-full p-2 border rounded mt-2"
                                        >
                                            <option value="all">すべて</option>
                                            <option value="watched">
                                                見た
                                            </option>
                                            <option value="not_watched">
                                                見てない
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                        >
                            <button
                                @click="toggleModal"
                                type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                閉じる
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
