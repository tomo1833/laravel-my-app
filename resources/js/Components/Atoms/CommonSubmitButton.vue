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
        class="w-32 select-none rounded-lg bg-blue-600 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-600/10 transition-all hover:shadow-lg hover:shadow-blue-600/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    >
        {{ props.text }}
    </button>
</template>
