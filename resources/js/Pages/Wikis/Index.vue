<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

defineProps({
    wikis: Array<object>,
});
</script>

<template>
    <Head title="ウィキ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ウィキ
            </h2>
        </template>
        <div
            v-if="$page.props.flash.status === 'create'"
            class="w-full p-8 bg-blue-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>
        <div
            v-if="$page.props.flash.status === 'denger'"
            class="w-full p-8 bg-blue-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div></div>
            <div class="p-4 2xl:px-64">
                <CommonLinkButton
                    routePath="wiki.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>
        <div class="bg-[#FFFFFF] mx-4 my-2">
            <table
                class="table-auto w-full text-left whitespace-no-wrap text-gray-500"
            >
                <thead class="text-xs text-gray-700 uppercase bg-[#F4F4F4]">
                    <tr>
                        <th scope="col" class="py-3 px-6">タイトル</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="wiki in wikis" class="bg-white border-b">
                        <td class="py-4 px-6">
                            {{ wiki.title }}
                        </td>
                        <td class="py-4 px-6">
                            <CommonLinkButton
                                routePath="wiki.show"
                                text="詳細"
                                styleType="table"
                                :params="{ wiki: wiki.id }"
                            />
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <CommonLinkButton
                                routePath="wiki.edit"
                                text="編集"
                                styleType="table"
                                :params="{ wiki: wiki.id }"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
