<template>
    <div class="special-node">
        <div>{{ data.label }}</div>
        <div>{{ data.hello }}</div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped>
.special-node {
    padding: 10px;
    background: #ffd700;
    border: 1px solid #000;
    border-radius: 5px;
    text-align: center;
}
</style>
