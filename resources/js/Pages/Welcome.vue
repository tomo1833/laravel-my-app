<script setup lang="ts">
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const handleImageError = () => {
    const screenshotContainer = document.getElementById("screenshot-container");
    const docsCard = document.getElementById("docs-card");
    const docsCardContent = document.getElementById("docs-card-content");
    const background = document.getElementById("background");

    screenshotContainer?.classList.add("!hidden");
    docsCard?.classList.add("!row-span-1");
    docsCardContent?.classList.add("!flex-row");
    background?.classList.add("!hidden");
};

const message = ref("");
const chatMessages = ref([]);
</script>

<template>
    <div
        class="flex flex-col h-screen items-center justify-center bg-green-300 text-black/50 dark:bg-black dark:text-white/50"
    >
        <header class="h-16 py-1 bg-white w-full">
            <nav v-if="canLogin" class="flex flex-1 justify-end pr-8">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        <div
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Log in
                        </div>
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        <div
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Register
                        </div>
                    </Link>
                </template>
            </nav>
        </header>

        <main class="flex-1 flex flex-col items-center justify-center">
            <h1 class="text-center text-4xl font-bold">
                パーソナルオーガナイザーシステム
            </h1>
            <p>
                あなたの生活を一括管理するウェブページ。スケジュール、趣味、勉強、勤怠の全てを効率的に整理し、目標達成をサポートします。シンプルな操作で日々の生活をより豊かに、計画的に。
            </p>
        </main>
        <footer
            class="h-10 py-2 items-center bg-white w-full text-center flex justify-center"
        >
            © 2024 tomo. All rights reserved.
        </footer>
    </div>
</template>
