<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonTitle from "@/Components/Atoms/CommonTitle.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";

const form = useForm("post", "/educationLarge", {
    id: null,
    name: null,
    order: null,
});

const storeEducationlarge = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="教育大項目" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeEducationlarge">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="pb-10">
                        <CommonBackLink routePath="educationLarge.index" />
                    </div>
                    <CommonTitle title="教育大項目" />
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
                    <div class="flex flex-row justify-evenly">
                        <div>
                            <CommonSubmitButton text="登録" />
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
