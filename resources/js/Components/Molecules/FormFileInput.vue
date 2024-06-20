<script setup lang="ts">
import { defineProps, ref } from "vue";

/**
 * @typedef {Object} Props
 * @property {string} label - 入力フィールドのラベル
 * @property {string} [error] - 表示するエラーメッセージ
 * @property {Function} handleFileChange - ファイルが選択されたときに呼び出される関数
 */

/** @type {Props} */
const props = defineProps({
    label: String,
    error: String,
    onFileChange: Function,
});

const imageUrl = ref<string | null>(null);

/**
 * ファイル選択イベントを処理し、選択されたファイルのURLを生成して表示する
 *
 * @param {Event} event - ファイル選択イベント
 */
const handleFileChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0] || null;
    if (file) {
        imageUrl.value = URL.createObjectURL(file);
        props.onFileChange(file);
    } else {
        imageUrl.value = null;
    }
};
</script>

<template>
    <div class="mb-4">
        <label class="block mb-2">{{ props.label }}</label>
        <input
            type="file"
            @change="handleFileChange"
            class="p-2 border rounded w-full"
        />
        <div v-if="props.error" class="text-red-500">{{ props.error }}</div>
        <img v-if="imageUrl" :src="imageUrl" class="mt-4" />
    </div>
</template>
