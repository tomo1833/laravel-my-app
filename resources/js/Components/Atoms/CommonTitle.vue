<script setup lang="ts">
import { defineProps } from "vue";

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} title - タイトル
 */

/** @type {Props} */
const props = defineProps<{
    title: string;
}>();
</script>

<template>
    <h1
        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 text-center"
    >
        {{ props.title }}
    </h1>
</template>
