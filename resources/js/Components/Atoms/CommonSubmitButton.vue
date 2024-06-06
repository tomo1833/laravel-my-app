<script setup lang="ts">
import { defineProps } from "vue";

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} text - ボタンに表示するテキスト
 */

/** @type {Props} */
const props = defineProps<{
    text: string;
}>();
</script>

<template>
    <button
        type="submit"
        class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
    >
        {{ props.text }}
    </button>
</template>
