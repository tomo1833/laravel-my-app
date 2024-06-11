<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import { ref, computed } from "vue";

const props = defineProps({
    blogs: Array<object>,
});

const searchQuery = ref("");

const filteredBlogs = computed(() => {
    if (!searchQuery.value) {
        return props.blogs;
    }
    return props.blogs.filter((blog) => {
        const title = blog.title ? blog.title.toLowerCase() : "";
        const query = searchQuery.value.toLowerCase();
        return title.includes(query);
    });
});
</script>

<template>
    <Head title="ブログ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ブログ
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
                    routePath="blog.create"
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
                            <th scope="col" class="py-3 px-6">タイトル</th>
                            <th scope="col" class="py-3 px-6"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="blog in filteredBlogs"
                            :key="blog.id"
                            class="bg-white border-b"
                        >
                            <td class="py-4 px-6">
                                {{ blog.title }}
                            </td>
                            <td class="py-4 px-6">
                                <CommonLinkButton
                                    routePath="blog.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ blog: blog.id }"
                                />
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <CommonLinkButton
                                    routePath="blog.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ blog: blog.id }"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
