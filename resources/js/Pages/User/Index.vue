<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

/**
 * ユーザーの構造を定義するインターフェースです。
 * @interface
 * @property {number} id - ユーザーの一意の識別子です。
 * @property {string} name - ユーザーの名前です。
 * @property {string} email - ユーザーのメールアドレスです。
 * @property {Array<{name: string}>} roles - ユーザーに関連付けられたロールのリストです。
 */
interface User {
    id: number;
    name: string;
    email: string;
    roles: Array<{ name: string }>;
}

/**
 * 親コンポーネントから期待されるプロパティを定義します。
 * @typedef {Object} Props
 * @property {User[]} users - 表示するユーザーオブジェクトの配列です。
 */
const props = defineProps<{
    users: User[];
}>();
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div class="px-4 flex space-x-4"></div>

            <div class="p-4"></div>
            <div class="p-4 2xl:px-64">
                <CommonLinkButton
                    routePath="user.create"
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
                            <th class="py-3 px-6">名前</th>
                            <th class="py-3 px-6">メール</th>
                            <th class="py-3 px-6">ロール</th>
                            <th class="py-3 px-6">操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="user in users"
                            :key="user.id"
                            class="bg-white border-b"
                        >
                            <td class="py-2 px-2 h-16">{{ user.name }}</td>
                            <td class="py-2 px-2 h-16">{{ user.email }}</td>
                            <td class="py-2 px-2 h-16">
                                <!-- ロールの配列をコンマ区切りのロール名の文字列に変換します。 -->
                                {{
                                    user.roles
                                        .map((role) => role.name)
                                        .join(", ")
                                }}
                            </td>
                            <td class="py-2 px-2 h-16">
                                <!-- 編集や削除のボタンを配置 -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
