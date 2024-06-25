<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonHeaderTitl from "@/Components/Atoms/CommonHeaderTitl.vue";
import FlashMessage from "@/Components/Atoms/CommonFlashMessage.vue";

defineProps({
    todos: Array<object>,
});

const updateStatus = (todoId: number, newStatus: string) => {
    const form = useForm({
        status: newStatus,
    });

    form.patch(route("todo.updateStatus", { todo: todoId }), {
        onSuccess: () => {
            // 成功した場合の処理
            console.log("Status updated successfully");
        },
        onError: (errors) => {
            // エラーが発生した場合の処理
            console.log("Error updating status", errors);
        },
    });
};
</script>

<template>
    <Head title="todo" />
    <AuthenticatedLayout>
        <template #header>
            <CommonHeaderTitl text="todo" />
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
                    routePath="todo.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>
        <div class="mx-0 sm:mx-2 2xl:mx-4 my-1">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 overflow-y-auto h-[calc(100vh-250px)]"
            >
                <template v-for="todo in todos" :key="todo.id">
                    <div
                        :class="{
                            'bg-gray-400': todo.status === 2,
                            'bg-white': todo.status !== 2,
                        }"
                        class="relative flex flex-col text-gray-700 shadow-md bg-clip-border rounded-xl h-96"
                    >
                        <div
                            class="relative h-2 mx-auto mt-4 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl"
                        ></div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h5
                                class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900"
                            >
                                {{ todo.title }}
                            </h5>
                            <p
                                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit mb-2"
                            >
                                {{
                                    todo.status === 0
                                        ? "未実施"
                                        : todo.status === 1
                                          ? "進行中"
                                          : todo.status === 2
                                            ? "完了"
                                            : ""
                                }}
                            </p>
                            <div class="mt-auto flex space-x-2">
                                <CommonLinkButton
                                    routePath="todo.show"
                                    text="詳細"
                                    styleType="table"
                                    :params="{ todo: todo.id }"
                                />
                                <CommonLinkButton
                                    routePath="todo.edit"
                                    text="編集"
                                    styleType="table"
                                    :params="{ todo: todo.id }"
                                />

                                <button
                                    @click="updateStatus(todo.id, '1')"
                                    class="w-32 bg-blue-500 text-white p-1 rounded"
                                >
                                    進行中
                                </button>
                                <button
                                    @click="updateStatus(todo.id, '2')"
                                    class="w-32 bg-blue-500 text-white p-1 rounded"
                                >
                                    完了
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
