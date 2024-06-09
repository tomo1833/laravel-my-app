<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
const form = useForm("post", "/educationSmall", {
    id: null,
    name: null,
    order: null,
});
const storeEducationsmall = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="教育小項目" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeEducationsmall">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        教育小項目
                    </h1>

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
                    <CommonSubmitButton text="登録" />
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
