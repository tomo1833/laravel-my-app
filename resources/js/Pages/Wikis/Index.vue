<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
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
            v-if="$page.props.flash.status === 'sucess'"
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
                <Link
                    as="button"
                    :href="route('wiki.create')"
                    class="bg-[#5568FE] text-white px-4 py-2 rounded"
                >
                    登録
                </Link>
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
                            <Link
                                as="button"
                                :href="
                                    route('wiki.show', {
                                        wiki: wiki.id,
                                    })
                                "
                                class="bg-[#F5F5F5] text-[#394264] px-3 py-1 rounded"
                            >
                                詳細
                            </Link>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <Link
                                as="button"
                                :href="
                                    route('wiki.edit', {
                                        wiki: wiki.id,
                                    })
                                "
                                class="bg-[#F5F5F5] text-[#394264] px-3 py-1 rounded"
                            >
                                編集
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
