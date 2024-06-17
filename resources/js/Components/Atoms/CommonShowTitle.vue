<script setup lang="ts">
import { defineProps } from "vue";

/**
 * コンポーネントのプロパティを定義します。
 *
 * @property {string} title - 表示するタイトル
 */
const props = defineProps<{
    title: string;
}>();
</script>

<template>
    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
        {{ props.title }}
    </h1>
</template>
