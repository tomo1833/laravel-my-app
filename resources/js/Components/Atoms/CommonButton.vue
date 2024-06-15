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
    <div>
        <button
            @click="handleClick"
            class="select-none rounded-lg bg-blue-600 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-600/10 transition-all hover:shadow-lg hover:shadow-blue-600/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        >
            {{ props.text }}
        </button>
    </div>
</template>
