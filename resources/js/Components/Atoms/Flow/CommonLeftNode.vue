<script setup lang="ts">
import { defineProps } from "vue";
import { Handle, Position } from "@vue-flow/core";

/**
 * カスタムノードのプロパティを定義します。
 *
 * @typedef {Object} Props
 * @property {Object} data - ノードのデータ。`label` を含む必要があります。
 */

/**
 * プロパティを受け取り、カスタムノードの設定を行います。
 *
 * @type {Props}
 */
const props = defineProps({
    data: Object,
});
</script>

<template>
    <div
        class="custom-node flex items-center justify-between p-2 border border-gray-300 bg-white w-64"
    >
        <Handle id="left" type="target" :position="Position.Left" />

        <div class="text-center w-full">{{ props.data.label }}</div>
    </div>
</template>
