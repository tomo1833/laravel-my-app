<script setup lang="ts">
import { defineProps, defineEmits } from "vue";

interface Option {
    value: string | number;
    label: string;
}

/**
 * フォームフィールドのラベル
 * @type {string}
 */
const props = defineProps<{
    label: string;
    name: string;
    modelValue: string | number;
    options: Option[];
    error: string;
}>();

/**
 * v-modelによるバインディングの値を更新するイベント
 */
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="mb-4">
        <label :for="name" class="block mb-2">{{ props.label }}</label>
        <select
            :id="props.name"
            :name="props.name"
            :v-model="props.modelValue"
            class="w-full border border-gray-300 rounded-md shadow-sm p-2"
        >
            <option
                v-for="option in props.options"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
        <div v-if="props.error" class="text-red-500">
            {{ props.error }}
        </div>
    </div>
</template>
