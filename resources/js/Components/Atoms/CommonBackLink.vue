<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowLeft } from "@fortawesome/free-solid-svg-icons";
import { defineProps } from "vue";

/**
 * コンポーネントのプロパティを定義します。
 *
 * @property {string} routePath - ルートパス
 */
const props = defineProps<{
    routePath: string;
}>();
</script>

<template>
    <Link as="button" :href="route(props.routePath)" class="underline">
        <FontAwesomeIcon :icon="faArrowLeft" class="mr-2" />戻る
    </Link>
</template>
