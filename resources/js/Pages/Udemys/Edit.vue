<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";

const props = defineProps({
    udemy: Object,
});

const form = useForm("put", "/udemy/" + props.udemy.id, {
    id: props.udemy.id,
    title: props.udemy.title,
    body: props.udemy.body,
});

const updateUdemy = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteUdemy = (id) => {
    Inertia.delete(route("udemy.destroy", { udemy: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="udemy" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateUdemy">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="flex flex-col text-center w-full mb-12 h-full">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            udemy
                        </h1>
                    </div>

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
                            @click="deleteUdemy(form.id)"
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
