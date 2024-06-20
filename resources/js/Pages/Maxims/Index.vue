<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonHeaderTitl from "@/Components/Atoms/CommonHeaderTitl.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
defineProps({
    maxims: Array<object>,
});
</script>

<template>
    <Head title="名言" />
    <AuthenticatedLayout>
        <template #header>
            <CommonHeaderTitl text="名言" />
        </template>

        <FlashMessage
            v-if="$page.props.flash.status"
            :status="$page.props.flash.status"
            :message="$page.props.flash.message"
        />

        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div></div>
            <div class="p-4 2xl:px-64">
                <CommonLinkButton
                    routePath="maxim.create"
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
                        <th scope="col" class="py-3 px-6">名称</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="maxim in maxims" class="bg-white border-b">
                        <td class="py-4 px-6">
                            {{ maxim.title }}
                        </td>
                        <td class="py-4 px-6">
                            <CommonLinkButton
                                routePath="maxim.show"
                                text="詳細"
                                styleType="table"
                                :params="{ maxim: maxim.id }"
                            />
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <CommonLinkButton
                                routePath="maxim.edit"
                                text="編集"
                                styleType="table"
                                :params="{ maxim: maxim.id }"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
