<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";

import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonTitle from "@/Components/Atoms/CommonTitle.vue";

const props = defineProps({
    educationSmall: Object,
});

const form = useForm("put", "/educationSmall/" + props.educationSmall.id, {
    id: props.educationSmall.id,
    name: props.educationSmall.name,
    order: props.educationSmall.order,
});

const updateEducationsmall = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteEducationsmall = (id) => {
    Inertia.delete(route("educationSmall.destroy", { educationSmall: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="教育小項目" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateEducationsmall">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="pb-10">
                        <CommonBackLink routePath="educationSmall.index" />
                    </div>

                    <CommonTitle title="教育小項目" />

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
                            @click="deleteEducationsmall(form.id)"
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
