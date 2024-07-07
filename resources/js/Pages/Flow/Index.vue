<script setup lang="ts">
import { ref } from "vue";
import type { Node, Edge } from "@vue-flow/core";
import { VueFlow, Panel } from "@vue-flow/core";

import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const nodes = ref<Node[]>([
    {
        id: "1",
        position: { x: 0, y: 0 },
        data: { label: "Internet" },
        draggable: false,
    },
    {
        id: "2",
        position: { x: 0, y: 150 },
        data: { label: "HTML" },
        draggable: false,
    },
    {
        id: "3",
        position: { x: 0, y: 300 },
        data: { label: "CSS" },
        draggable: false,
    },
    {
        id: "4",
        position: { x: 0, y: 450 },
        data: { label: "JAVASCRIPT" },
        draggable: false,
    },
]);

const edges = ref<Edge[]>([
    {
        id: "e1->2",
        source: "1",
        target: "2",
        animated: true,
    },
    {
        id: "e2->3",
        source: "2",
        target: "3",
        animated: true,
    },
    {
        id: "e3->4",
        source: "3",
        target: "4",
        animated: true,
    },


]);
function addNode() {
    const id = Date.now().toString();

    nodes.value.push({
        id,
        position: { x: 150, y: 50 },
        data: { label: `Node ${id}` },
    });
}
</script>

<template>
    <Head title="FLOW" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <VueFlow
                :nodes="nodes"
                :edges="edges"
                class="vue-flow-basic-example"
                :default-zoom="1.5"
                :min-zoom="0.2"
                :max-zoom="4"
            >
                <Panel position="top-center">
                    <button type="button" @click="addNode">Add a node</button>
                </Panel>
            </VueFlow>
        </section>
    </AuthenticatedLayout>
</template>

<style>
/* import the necessary styles for Vue Flow to work */
@import "@vue-flow/core/dist/style.css";
@import "@vue-flow/core/dist/theme-default.css";
.vue-flow {
    width: 100%;
    height: 80vh;
}
</style>
