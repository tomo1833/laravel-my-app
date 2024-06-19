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

const getYoutubeId = (url: string) => {
    const regExp =
        /^.*(youtu.be\/|v\/|\/u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return match && match[2].length === 11 ? match[2] : null;
};

const showVideo = ref<Record<number, boolean>>({});

const toggleVideo = (id: number) => {
    showVideo.value[id] = !showVideo.value[id];
    console.log(
        "Toggled video state for ID:",
        id,
        "New state:",
        showVideo.value[id],
    );
};
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
        <div class="mx-0 sm:mx-2 2xl:mx-4 my-1">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 overflow-y-auto h-[calc(100vh-250px)]"
            >
                <template v-for="music in filteredMusics" :key="music.id">
                    <div
                        class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl h-96"
                    >
                        <div
                            class="relative h-32 mx-auto mt-4 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl"
                        >
                            <div
                                v-if="!showVideo[music.id]"
                                class="relative w-[256px] h-[144px] mx-auto cursor-pointer"
                                @click="toggleVideo(music.id)"
                            >
                                <img
                                    :src="`https://img.youtube.com/vi/${getYoutubeId(music.youtube_url)}/hqdefault.jpg`"
                                    alt="YouTube Thumbnail"
                                    class="absolute top-0 left-0 w-full h-full object-cover"
                                />
                                <div
                                    class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50"
                                >
                                    <i
                                        class="fas fa-play text-white text-3xl"
                                    ></i>
                                </div>
                            </div>
                            <div
                                v-else
                                class="relative w-[256px] h-[144px] mx-auto"
                            >
                                <iframe
                                    class="absolute top-0 left-0 w-full h-full"
                                    :src="`https://www.youtube.com/embed/${getYoutubeId(music.youtube_url)}?autoplay=1`"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h5
                                class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900"
                            >
                                {{ music.title }}
                            </h5>
                            <p
                                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit mb-2"
                            ></p>
                            <div class="mt-auto">
                                {{ music.artist }}
                            </div>
                            <div class="mt-auto flex space-x-2">
                                <CommonLinkButton
                                    routePath="music.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ music: music.id }"
                                />
                                <CommonLinkButton
                                    routePath="music.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ music: music.id }"
                                />
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
exi
