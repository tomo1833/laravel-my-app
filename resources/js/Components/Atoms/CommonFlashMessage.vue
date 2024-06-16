<script setup lang="ts">
import { defineProps, computed, ref, onMounted } from "vue";

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} status - メッセージのステータス（'create' または 'delete'）
 * @property {string} message - 表示するメッセージテキスト
 */

/** @type {Props} */
const props = defineProps<{
    status: string;
    message: string;
}>();

/**
 * ステータスに応じたクラスを計算するためのリアクティブな計算プロパティ
 * @returns {string} - ステータスに応じたクラス名
 */
const statusClass = computed(() => {
    if (props.status === "create") {
        return "bg-blue-300";
    } else if (props.status === "delete") {
        return "bg-red-300";
    } else {
        return "";
    }
});

/**
 * メッセージの表示/非表示を管理するリアクティブなフラグ
 * @type {import('vue').Ref<boolean>}
 */
const visible = ref(true);

/**
 * コンポーネントがマウントされたときに実行される関数
 * 5秒後にメッセージを非表示にする
 */
onMounted(() => {
    setTimeout(() => {
        visible.value = false;
    }, 5000);
});
</script>

<template>
    <div
        v-if="visible"
        :class="[
            statusClass,
            'fixed inset-x-0 top-1/2 transform -translate-y-1/2 flex justify-center z-10',
        ]"
    >
        <div class="w-auto max-w-lg p-8 text-white text-center rounded-lg">
            {{ props.message }}
        </div>
    </div>
</template>
