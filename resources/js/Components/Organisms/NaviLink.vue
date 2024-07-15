<script setup lang="ts">
import { ref, reactive, computed } from "vue";
import CommonNaviLink from "@/Components/Atoms/CommonNaviLink.vue";
import { usePage } from "@inertiajs/vue3";

interface MenuItem {
    text: string;
    routePath?: string;
    isLink: boolean;
    roles?: string[];
    children?: MenuItem[];
}

const { props } = usePage();
const roles = computed(() => props.auth.roles);

const menuItems = ref<MenuItem[]>([
    {
        text: "ダッシュボード",
        isLink: false,
        children: [
            {
                text: "ダッシュボード",
                routePath: "dashboard",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "todo",
                routePath: "todo.index",
                isLink: true,
                roles: ["admin", "member"],
            },
        ],
        roles: ["admin", "member"],
    },
    {
        text: "勤怠管理",
        isLink: false,
        children: [
            {
                text: "勤怠管理",
                routePath: "attendance.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "スケジュール",
                routePath: "events.index",
                isLink: true,
                roles: ["admin", "member"],
            },
        ],
        roles: ["admin", "member"],
    },
    {
        text: "教育",
        isLink: false,
        children: [
            {
                text: "教育管理",
                routePath: "education.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "udemy",
                routePath: "udemy.index",
                isLink: true,
                roles: ["admin", "member"],
            },
        ],
        roles: ["admin", "member"],
    },
    {
        text: "趣味",
        isLink: false,
        children: [
            {
                text: "アニメ",
                routePath: "anime.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "本",
                routePath: "book.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "ブログ",
                routePath: "blog.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "音楽",
                routePath: "music.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "将棋",
                routePath: "shougi.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "漫画",
                routePath: "manga.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "映画",
                routePath: "movie.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "小説",
                routePath: "novel.index",
                isLink: true,
                roles: ["admin", "member"],
            },
            {
                text: "名言",
                routePath: "maxim.index",
                isLink: true,
                roles: ["admin", "member"],
            },
        ],
        roles: ["admin", "member"],
    },
    {
        text: "wiki",
        isLink: false,
        children: [
            {
                text: "ウィキ",
                routePath: "wiki.index",
                isLink: true,
                roles: ["admin", "member"],
            },
        ],
        roles: ["admin", "member"],
    },
    {
        text: "マスター",
        isLink: false,
        children: [
            {
                text: "教育大項目",
                routePath: "educationLarge.index",
                isLink: true,
                roles: ["admin"],
            },
            {
                text: "教育中項目",
                routePath: "educationMiddle.index",
                isLink: true,
                roles: ["admin"],
            },
            {
                text: "教育小項目",
                routePath: "educationSmall.index",
                isLink: true,
                roles: ["admin"],
            },
            {
                text: "アニメジャンル",
                routePath: "animeGenres.index",
                isLink: true,
                roles: ["admin"],
            },
            {
                text: "放送年期",
                routePath: "broadcast_period.index",
                isLink: true,
                roles: ["admin"],
            },
            {
                text: "ユーザ管理",
                routePath: "user.index",
                isLink: true,
                roles: ["admin"],
            },
        ],
        roles: ["admin"],
    },
    {
        text: "その他",
        isLink: false,
        children: [
            { text: "カメラ", routePath: "camera.index", isLink: true },
            { text: "画像", routePath: "images.index", isLink: true },
            { text: "FLOW", routePath: "flow.index", isLink: true },
            { text: "DATA", routePath: "data.index", isLink: true },
        ],
        roles: ["admin", "member"],
    },
]);

const hoverIndex = reactive({
    index: -1,
});

// 役割に基づいてメニューアイテムをフィルタリング
const filteredMenuItems = computed(() => {
    return menuItems.value
        .map((item) => {
            if (item.children) {
                const filteredChildren = item.children.filter((child) => {
                    if (!child.roles) return true; // 役割が定義されていない場合は表示
                    return child.roles.some((role) =>
                        roles.value.includes(role),
                    );
                });
                // 子要素が表示可能な場合のみ親要素を表示
                if (filteredChildren.length > 0) {
                    return { ...item, children: filteredChildren };
                }
            }
            if (!item.roles) return item; // 役割が定義されていない場合は表示
            if (item.roles.some((role) => roles.value.includes(role)))
                return item; // 親要素が表示可能
        })
        .filter((item) => item !== undefined); // フィルタリングでundefinedになった要素を除去
});
</script>

<template>
    <div class="hidden space-x-8 px-4 sm:flex">
        <ul class="flex w-full justify-evenly p-2 bg-white text-black">
            <li
                v-for="(item, index) in filteredMenuItems"
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
