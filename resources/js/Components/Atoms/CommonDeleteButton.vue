<script setup lang="ts">
import { defineProps, defineEmits } from "vue";

/**
 * @typedef {Object} Props
 * @property {string} text - ボタンに表示するテキスト
 * @property {Function} onClick - ボタンがクリックされたときの処理
 */

/** @type {Props} */
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    onClick: {
        type: Function,
        required: true,
    },
});

const emits = defineEmits(["click"]);

const handleClick = () => {
    if (confirm("削除しますか？")) {
        emits("click");
    }
};
</script>

<template>
    <button
        type="button"
        @click="handleClick"
        class="w-32 select-none rounded-lg bg-red-600 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-600/10 transition-all hover:shadow-lg hover:shadow-blue-600/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    >
        {{ props.text }}
    </button>
</template>
