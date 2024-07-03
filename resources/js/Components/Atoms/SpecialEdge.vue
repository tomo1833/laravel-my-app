<template>
    <path :d="path" class="special-edge" />
</template>

<script setup>
import { ref, watchEffect } from "vue";
import { useEdge } from "@vue-flow/core";

const edge = useEdge();
const path = ref("");

watchEffect(() => {
    if (edge.value && edge.value.source && edge.value.target) {
        const { x: x1, y: y1 } = edge.value.source;
        const { x: x2, y: y2 } = edge.value.target;

        path.value = `M${x1},${y1}C${x1},${y1 + 50},${x2},${y2 - 50},${x2},${y2}`;
    }
});
</script>

<style scoped>
.special-edge {
    stroke: #ff0000;
    stroke-width: 2;
    fill: none;
}
</style>
