<script setup lang="ts">
import { defineProps, defineEmits } from "vue";

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} text - ボタンに表示するテキスト
 */

/** @type {Props} */
const props = defineProps<{
    text: string;
}>();

/**
 * カスタムイベントの定義
 * @emits clickEvent - ボタンがクリックされたときに発火されるイベント
 */
const emit = defineEmits(["clickEvent"]);

/**
 * クリックイベントハンドラ
 * ボタンがクリックされたときにclickEventを発火する
 */
const handleClick = () => {
    emit("clickEvent");
};
</script>

<template>
    <button
        @click="handleClick"
        class="w-32 bg-blue-600 text-white px-4 py-2 rounded"
    >
        {{ props.text }}
    </button>
</template>
