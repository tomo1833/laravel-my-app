<script setup lang="ts">
import { ref } from "vue";
import type { Node, Edge } from "@vue-flow/core";
import { VueFlow, Panel } from "@vue-flow/core";

import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import CommonButtomRightNode from "@/Components/Atoms/Flow/CommonButtomRightNode.vue";
import CommonTopButtomLeftNode from "@/Components/Atoms/Flow/CommonTopButtomLeftNode.vue";
import CommonLeftNode from "@/Components/Atoms/Flow/CommonLeftNode.vue";

const nodes = ref<Node[]>([
    {
        id: "1",
        type: "CommonButtomRightNode",
        position: { x: 50, y: 75 },
        data: { label: "Internet" },
        draggable: false,
    },
    {
        id: "2",
        type: "CommonLeftNode",
        position: { x: 250, y: 0 },
        data: { label: "Internet" },
        draggable: false,
    },
    {
        id: "3",
        type: "CommonLeftNode",
        position: { x: 250, y: 50 },
        data: { label: "http" },
        draggable: false,
    },
    {
        id: "4",
        type: "CommonLeftNode",
        position: { x: 250, y: 100 },
        data: { label: "domain" },
        draggable: false,
    },
    {
        id: "5",
        type: "CommonLeftNode",
        position: { x: 250, y: 150 },
        data: { label: "hosting" },
        draggable: false,
    },
    {
        id: "6",
        type: "CommonLeftNode",
        position: { x: 250, y: 200 },
        data: { label: "dns" },
        draggable: false,
    },
    {
        id: "7",
        type: "CommonTopButtomLeftNode",
        position: { x: 50, y: 300 },
        data: { label: "css" },
        draggable: false,
    },
    {
        id: "8",
        type: "CommonTopButtomLeftNode",
        position: { x: 50, y: 450 },
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
        sourceHandle: "right",
        targetHandle: "left",
    },
    {
        id: "e1->3",
        source: "1",
        target: "3",
        animated: true,
        sourceHandle: "right",
        targetHandle: "left",
    },
    {
        id: "e1->4",
        source: "1",
        target: "4",
        animated: true,
        sourceHandle: "right",
        targetHandle: "left",
    },
    {
        id: "e1->5",
        source: "1",
        target: "5",
        animated: true,
        sourceHandle: "right",
        targetHandle: "left",
    },
    {
        id: "e1->6",
        source: "1",
        target: "6",
        animated: true,
        sourceHandle: "right",
        targetHandle: "left",
    },
    {
        id: "e1->7",
        source: "1",
        target: "7",
        animated: true,
        sourceHandle: "buttom",
        targetHandle: "top",
    },
    {
        id: "e7->8",
        source: "7",
        target: "8",
        animated: true,
        sourceHandle: "buttom",
        targetHandle: "top",
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
                :nodeTypes="{
                    CommonButtomRightNode,
                    CommonTopButtomLeftNode,
                    CommonLeftNode,
                }"
                :default-zoom="1.5"
                :min-zoom="0.2"
                :max-zoom="4"
                class="vue-flow-basic-example"
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
