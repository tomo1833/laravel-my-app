<script setup lang="ts">
import { defineProps, computed } from "vue";

const props = defineProps({
    status: String,
    message: String,
});

const statusClass = computed(() => {
    if (props.status === "create") {
        return "bg-blue-300";
    } else if (props.status === "delate") {
        return "bg-red-300";
    } else {
        return "";
    }
});
</script>

<template>
    <div v-if="status" :class="statusClass" class="w-full p-8 text-white">
        {{ message }}
    </div>
</template>
