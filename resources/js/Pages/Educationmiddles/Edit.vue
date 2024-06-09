<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";

const props = defineProps({
    educationMiddle: Object,
});

const form = useForm("put", "/educationMiddle/" + props.educationMiddle.id, {
    id: props.educationMiddle.id,
    name: props.educationMiddle.name,
    order: props.educationMiddle.order,
});

const updateEducationmiddle = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteEducationmiddle = (id) => {
    Inertia.delete(route("educationMiddle.destroy", { educationMiddle: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="教育中項目" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateEducationmiddle">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="flex flex-col text-center w-full mb-12 h-full">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            教育中項目
                        </h1>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">名称</label>
                        <input
                            type="text"
                            name="name"
                            v-model="form.name"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('name')" class="text-red-500">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">表示順</label>
                        <input
                            type="text"
                            name="order"
                            v-model="form.order"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('order')" class="text-red-500">
                            {{ form.errors.order }}
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
                            @click="deleteEducationmiddle(form.id)"
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
