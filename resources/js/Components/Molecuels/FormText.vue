<script setup lang="ts">
import { defineProps, defineEmits, ref, watch } from "vue";

/**
 * FormTextコンポーネントのプロパティ
 *
 * @typedef {Object} Props
 * @property {string} label - 入力フィールドのラベル
 * @property {string} [type=text] - 入力フィールドのタイプ
 * @property {string} name - 入力フィールドの名前とID
 * @property {string} modelValue - 入力フィールドにバインドされた値
 * @property {string} [error] - 表示するエラーメッセージ
 */

/** @type {Props} */
const props = defineProps({
    label: String,
    type: {
        type: String,
        default: "text",
    },
    name: String,
    modelValue: String,
    error: String,
});

/**
 * FormTextコンポーネントのイベント
 *
 * @typedef {Object} Emits
 * @property {function(string): void} update:modelValue - 入力フィールドの更新された値を発火するイベント
 */

/** @type {Emits} */
const emits = defineEmits(["update:modelValue"]);

/**
 * 入力フィールドの内部値
 * @type {import('vue').Ref<string>}
 */
const internalValue = ref(props.modelValue);

/**
 * props.modelValueが変更されたときにinternalValueを更新するウォッチャー
 */
watch(
    () => props.modelValue,
    (newValue) => {
        internalValue.value = newValue;
    },
);
</script>

<template>
    <div>
        <label :for="name" class="block mb-2">{{ label }}</label>
        <input
            :type="type"
            :name="name"
            :id="name"
            v-model="internalValue"
            class="p-2 border rounded w-full"
            @input="$emit('update:modelValue', internalValue)"
        />
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </div>
</template>
