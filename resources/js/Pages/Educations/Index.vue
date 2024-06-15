<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonHeaderTitl from "@/Components/Atoms/CommonHeaderTitl.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";
import { ref, computed } from "vue";

const props = defineProps({
    educations: Array<object>,
});

const searchQuery = ref("");

const filteredEducations = computed(() => {
    if (!searchQuery.value) {
        return props.educations;
    }
    return props.educations.filter((education) => {
        const largeName = education.large_name
            ? education.large_name.toLowerCase()
            : "";
        const middleName = education.middle_name
            ? education.middle_name.toLowerCase()
            : "";
        const smallName = education.small_name
            ? education.small_name.toLowerCase()
            : "";
        const title = education.title ? education.title.toLowerCase() : "";
        const query = searchQuery.value.toLowerCase();
        return (
            largeName.includes(query) ||
            middleName.includes(query) ||
            smallName.includes(query) ||
            title.includes(query)
        );
    });
});
</script>

<template>
    <Head title="教育管理" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                教育管理
            </h2>
        </template>

        <FlashMessage
            v-if="$page.props.flash.status"
            :status="$page.props.flash.status"
            :message="$page.props.flash.message"
        />

        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div class="p-4">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="検索..."
                    class="p-2 border border-gray-300 rounded"
                />
            </div>
            <div class="p-4 2xl:px-64">
                <CommonLinkButton
                    routePath="education.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>

        <div class="bg-[#FFFFFF] mx-4 my-2">
            <div class="overflow-y-auto h-[calc(100vh-250px)]">
                <table
                    class="table-auto w-full text-left whitespace-no-wrap text-gray-500"
                >
                    <thead class="text-xs text-gray-700 uppercase bg-[#F4F4F4]">
                        <tr>
                            <th scope="col" class="py-3 px-6">大項目</th>
                            <th scope="col" class="py-3 px-6">中項目</th>
                            <th scope="col" class="py-3 px-6">小項目</th>
                            <th scope="col" class="py-3 px-6">タイトル</th>
                            <th scope="col" class="py-3 px-6">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="education in filteredEducations"
                            :key="education.id"
                            class="bg-white border-b"
                        >
                            <td class="py-4 px-2">
                                {{ education.large_name }}
                            </td>
                            <td class="py-4 px-2">
                                {{ education.middle_name }}
                            </td>
                            <td class="py-4 px-2">
                                {{ education.small_name }}
                            </td>
                            <td class="py-4 px-2">
                                {{ education.title }}
                            </td>
                            <td class="py-4 px-6">
                            <div class="flex">
                            <div>
                                <CommonLinkButton
                                    routePath="education.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ education: education.id }"
                                />
                                </div>
                                <div>

                                <CommonLinkButton
                                    routePath="education.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ education: education.id }"
                                />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
