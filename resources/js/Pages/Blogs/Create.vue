<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
const form = useForm("post", "/blog", {
    id: null,
    title: null,
    body: null,
});
const storeBlog = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="ブログ" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeBlog">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        ブログ
                    </h1>
                </div>

                <div class="mb-4">
                    <label class="block mb-2">タイトル</label>
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
                    <label class="block mb-2"></label>
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
                <button
                    type="submit"
                    tclass="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                >
                    登録
                </button>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
