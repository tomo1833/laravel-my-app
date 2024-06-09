<script setup lang="ts">
import { defineProps } from "vue";

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} text - ボタンに表示するテキスト
 * @type {Props}
 */
const props = defineProps<{
    text: string;
}>();
</script>

<template>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ props.text }}
    </h2>
</template>
