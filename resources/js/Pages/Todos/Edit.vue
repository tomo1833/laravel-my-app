<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";

import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";

const props = defineProps({
    todo: Object,
});

const form = useForm("put", "/todo/" + props.todo.id, {
    id: props.todo.id,
    title: props.todo.title,
    body: props.todo.body,
});

const updateTodo = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteTodo = (id) => {
    Inertia.delete(route("todo.destroy", { todo: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="todo" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateTodo">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="pb-10">
                        <CommonBackLink routePath="todo.index" />
                    </div>

                    <CommonTitle title="todo" />

                    <div class="mb-4">
                        <label class="block mb-2">名称</label>
                        <input
                            type="text"
                            name="title"
                            v-model="form.title"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('title')" class="text-red-500">
                            {{ form.errors.title }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">本文</label>
                        <input
                            type="text"
                            name="body"
                            v-model="form.body"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('body')" class="text-red-500">
                            {{ form.errors.body }}
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <button
                            type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            更新
                        </button>
                        <button
                            type="button"
                            @click="deleteTodo(form.id)"
                            class="mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                        >
                            削除
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
