<script setup lang="ts">
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

/**
 * プロパティの定義
 * @type {{ route: string, text: string }}
 * @property {string} route - リンク先のルート
 * @property {string} text - ボタンに表示するテキスト
 */
const props = defineProps<{
    routePath: string;
    text: string;
}>();
</script>

<template>
    <Link
        as="button"
        :href="route(props.routePath)"
        class="w-32 bg-blue-600 text-white px-4 py-2 rounded"
    >
        {{ props.text }}
    </Link>
</template>
