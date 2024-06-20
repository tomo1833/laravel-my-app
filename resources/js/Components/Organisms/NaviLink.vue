<script setup lang="ts">
import { ref, reactive } from "vue";
import CommonNaviLink from "@/Components/Atoms/CommonNaviLink.vue";

interface MenuItem {
    text: string;
    routePath?: string;
    isLink: boolean;
    children?: MenuItem[];
}

const menuItems = ref<MenuItem[]>([
    {
        text: "ダッシュボード",
        isLink: false,
        children: [
            { text: "ダッシュボード", routePath: "dashboard", isLink: true },
            { text: "todo", routePath: "todo.index", isLink: true },
        ],
    },
    {
        text: "勤怠管理",
        isLink: false,
        children: [
            { text: "勤怠管理", routePath: "attendance.index", isLink: true },
            { text: "スケジュール", routePath: "events.index", isLink: true },
        ],
    },
    {
        text: "教育",
        isLink: false,
        children: [
            { text: "教育管理", routePath: "education.index", isLink: true },
            { text: "udemy", routePath: "udemy.index", isLink: true },
        ],
    },
    {
        text: "趣味",
        isLink: false,
        children: [
            { text: "アニメ", routePath: "anime.index", isLink: true },
            { text: "本", routePath: "book.index", isLink: true },
            { text: "ブログ", routePath: "blog.index", isLink: true },
            { text: "音楽", routePath: "music.index", isLink: true },
            { text: "将棋", routePath: "shougi.index", isLink: true },
            { text: "漫画", routePath: "manga.index", isLink: true },
            { text: "映画", routePath: "movie.index", isLink: true },
            { text: "小説", routePath: "novel.index", isLink: true },
            { text: "名言", routePath: "maxim.index", isLink: true },
        ],
    },
    {
        text: "wiki",
        isLink: false,
        children: [{ text: "ウィキ", routePath: "wiki.index", isLink: true }],
    },
    {
        text: "マスター",
        isLink: false,
        children: [
            {
                text: "教育大項目",
                routePath: "educationLarge.index",
                isLink: true,
            },
            {
                text: "教育中項目",
                routePath: "educationMiddle.index",
                isLink: true,
            },
            {
                text: "教育小項目",
                routePath: "educationSmall.index",
                isLink: true,
            },
            {
                text: "アニメジャンル",
                routePath: "animeGenres.index",
                isLink: true,
            },
        ],
    },
    {
        text: "その他",
        isLink: false,
        children: [
            { text: "カメラ", routePath: "camera.index", isLink: true },
            { text: "画像", routePath: "images.index", isLink: true },
        ],
    },
]);

const hoverIndex = reactive({
    index: -1,
});
</script>

<template>
    <div class="hidden space-x-8 px-4 sm:flex">
        <ul class="flex w-full justify-evenly p-2 bg-white text-black">
            <li
                v-for="(item, index) in menuItems"
                :key="item.text"
                class="relative w-32 text-center block box-border"
                @mouseover="hoverIndex.index = index"
                @mouseleave="hoverIndex.index = -1"
            >
                <template v-if="item.isLink">
                    <CommonNaviLink
                        :routePath="item.routePath"
                        :text="item.text"
                        class="inline-block items-center justify-center h-full px-4 py-4 hover:bg-gray-200 whitespace-nowrap w-32"
                    />
                </template>
                <template v-else>
                    <div
                        class="inline-block items-center justify-center h-full px-6 pt-6 cursor-pointer hover:bg-gray-200 whitespace-nowrap w-32"
                    >
                        {{ item.text }}
                    </div>
                    <ul
                        v-if="hoverIndex.index === index"
                        class="absolute left-0 mt-1 bg-white text-black shadow-lg z-10"
                    >
                        <li
                            v-for="child in item.children"
                            :key="child.text"
                            class="whitespace-nowrap w-32 text-center block h-12"
                        >
                            <template v-if="child.isLink">
                                <CommonNaviLink
                                    :routePath="child.routePath"
                                    :text="child.text"
                                    class="block px-4 pt-2 hover:bg-gray-200 whitespace-nowrap w-32 h-12"
                                />
                            </template>
                            <template v-else>
                                <span
                                    class="block px-4 hover:bg-gray-200 whitespace-nowrap"
                                >
                                    {{ child.text }}
                                </span>
                            </template>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</template>

<style scoped>
ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

li {
    position: relative;
}

.common-navi-link {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 0 16px;
    white-space: nowrap;
}
</style>
