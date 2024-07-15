<script setup lang="ts">
import { onMounted, ref } from "vue";

/**
 * ref を用いて、入力フィールドの参照を作成します。
 * 定義されたモデルは必須です。
 */
const model = defineModel<string>({ required: true });

/**
 * 入力要素への参照。
 * 初期値は null で、HTMLInputElement の型アノテーションが付与されています。
 */
const input = ref<HTMLInputElement | null>(null);

/**
 * コンポーネントがマウントされた後に実行される関数。
 * autofocus 属性がある場合、入力フィールドにフォーカスを設定します。
 */
onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }
});

/**
 * コンポーネント外部からフォーカスを設定するためのメソッドです。
 */
defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        v-model="model"
        ref="input"
    />
</template>
