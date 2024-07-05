<script setup lang="ts">
import { defineProps, defineEmits } from "vue";

interface Option {
    value: string | number;
    label: string;
}

const props = defineProps<{
    label: string;
    name: string;
    modelValue: string | number;
    options: Option[];
    error: string;
}>();

const emit = defineEmits(["update:modelValue"]);

const updateValue = (event: Event) => {
    const value = (event.target as HTMLSelectElement).value;
    emit("update:modelValue", value);
};
</script>

<template>
    <div class="mb-4">
        <label :for="name" class="block mb-2">{{ label }}</label>
        <select
            :id="name"
            :name="name"
            :value="modelValue"
            @change="updateValue"
            class="w-full border border-gray-300 rounded-md shadow-sm p-2"
        >
            <option
                v-for="option in options"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
        <div v-if="error" class="text-red-500">
            {{ error }}
        </div>
    </div>
</template>
