<script setup lang="ts">
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

/**
 * ボタンのスタイルを定義するオブジェクト
 * @type {Object.<string, string>}
 */
const buttonStyles = {
    default: "w-32 bg-green-600 text-white px-4 py-2 rounded",
    primary:
        "select-none rounded-lg bg-blue-600 w-24 2xl:w-32 py-1 2xl:py-3 px-4 2xl:px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-600/10 transition-all hover:shadow-lg hover:shadow-blue-600/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none",
    delete: "w-32 bg-red-600 text-white px-4 py-2 rounded",
    table: "w-20 bg-gray-600 text-white px-2 py-1 rounded",
};

/**
 * プロパティの定義
 * @typedef {Object} Props
 * @property {string} routePath - リンク先のルート
 * @property {string} text - ボタンに表示するテキスト
 * @property {keyof buttonStyles} [styleType] - ボタンに適用するスタイルのタイプ
 * @property {Object.<string, number|string>} [params] - ルートに渡すパラメータのオブジェクト
 */

/** @type {Props} */
const props = defineProps<{
    routePath: string;
    text: string;
    styleType?: keyof typeof buttonStyles;
    params?: { [key: string]: number | string };
}>();

/**
 * 指定されたスタイルタイプに応じたクラス名を取得する関数
 * @param {keyof buttonStyles} [styleType='default'] - 使用するスタイルタイプ
 * @returns {string} - 対応するクラス名
 */
const getClass = (styleType: keyof typeof buttonStyles = "default") => {
    return buttonStyles[styleType] || buttonStyles.default;
};

/**
 * ルートを生成する関数
 * @param {string} routePath - リンク先のルート
 * @param {Object.<string, number|string>} [params] - ルートに渡すパラメータのオブジェクト
 * @returns {string} - 生成されたルート
 */
const generateRoute = (
    routePath: string,
    params?: { [key: string]: number | string },
) => {
    return params ? route(routePath, params) : route(routePath);
};
</script>

<template>
    <div clas="text-center">
        <Link
            as="button"
            :href="generateRoute(props.routePath, props.params)"
            :class="getClass(props.styleType)"
        >
            {{ props.text }}
        </Link>
    </div>
</template>
