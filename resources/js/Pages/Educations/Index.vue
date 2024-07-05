<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonStarRating from "@/Components/Atoms/CommonStarRating.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";

import { ref, computed } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

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

const isModalOpen = ref(false);
const toggleModal = () => {
    isModalOpen.value = !isModalOpen.value;
};
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
            <div class="px-4 flex space-x-4">
                <button
                    @click="toggleModal"
                    class="p-2 border border-gray-300 rounded"
                >
                    <FontAwesomeIcon :icon="faSearch" />
                </button>
            </div>

            <div class="p-4"></div>
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
                            <th scope="col" class="py-3 px-6">理解度</th>
                            <th scope="col" class="py-3 px-6">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="education in filteredEducations"
                            :key="education.id"
                            class="bg-white border-b"
                        >
                            <td class="py-2 px-2">
                                {{ education.large_name }}
                            </td>
                            <td class="py-2 px-2">
                                {{ education.middle_name }}
                            </td>
                            <td class="py-2 px-2">
                                {{ education.small_name }}
                            </td>
                            <td class="py-2 px-2">
                                {{ education.title }}
                            </td>
                            <td class="py-2 px-2">
                                <CommonStarRating v-model="education.score" />
                            </td>

                            <td class="py-2 px-6">
                                <div class="flex">
                                    <div class="px-2">
                                        <CommonLinkButton
                                            routePath="education.show"
                                            text="詳細"
                                            styleType="table"
                                            :params="{
                                                education: education.id,
                                            }"
                                        />
                                    </div>
                                    <div class="px-2">
                                        <CommonLinkButton
                                            routePath="education.edit"
                                            text="編集"
                                            styleType="table"
                                            :params="{
                                                education: education.id,
                                            }"
                                        />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- モーダルウィンドウ -->
        <transition name="fade">
            <div v-if="isModalOpen" class="fixed z-50 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="fixed inset-0 transition-opacity">
                        <div
                            class="absolute inset-0 bg-gray-500 opacity-75"
                        ></div>
                    </div>
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:text-left"
                                >
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                    >
                                        検索
                                    </h3>
                                    <div class="mt-2">
                                        <input
                                            type="text"
                                            v-model="searchQuery"
                                            placeholder="検索キーワード"
                                            class="w-full p-2 border rounded"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                        >
                            <button
                                @click="toggleModal"
                                type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                閉じる
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>
