<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonQuill from "@/Components/Atoms/CommonQuill.vue";
import FormSelect from "@/Components/Molecules/FormSelect.vue";

interface Option {
    value: string | number;
    label: string;
}

const props = defineProps({
    largeKbnList: Array<Option>,
    middleKbnList: Array<Option>,
    smallKbnList: Array<Option>,
});

const form = useForm("post", "/education", {
    id: null,
    title: null,
    body: null,
    body_html: null,
    order: null,
    large_kbn: null,
    middle_kbn: null,
    small_kbn: null,
});

const storeEducations = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="教育ページ登録" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeEducations">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="pb-10">
                        <CommonBackLink routePath="education.index" />
                    </div>
                    <div class="flex flex-col text-center w-full mb-12">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            教育ページ登録
                        </h1>
                    </div>
                    <div class="mb-4 flex justify-between">
                        <FormSelect
                            label="大項目"
                            name="large_kbn"
                            v-model:modelValue="form.large_kbn"
                            :options="largeKbnList"
                            :error="
                                form.invalid('large_kbn')
                                    ? form.errors.large_kbn
                                    : ''
                            "
                        />

                        <FormSelect
                            label="中項目"
                            name="middle_kbn"
                            v-model:modelValue="form.middle_kbn"
                            :options="middleKbnList"
                            :error="
                                form.invalid('middle_kbn')
                                    ? form.errors.middle_kbn
                                    : ''
                            "
                        />

                        <FormSelect
                            label="小項目"
                            name="small_kbn"
                            v-model:modelValue="form.small_kbn"
                            :options="smallKbnList"
                            :error="
                                form.invalid('small_kbn')
                                    ? form.errors.small_kbn
                                    : ''
                            "
                        />
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
                        <label class="block mb-2">本文（HTML）</label>
                        <CommonQuill
                            :content="form.body_html"
                            @update:content="
                                (newContent) => (form.body_html = newContent)
                            "
                        />
                        <div
                            v-if="form.invalid('body_html')"
                            class="text-red-500"
                        >
                            {{ form.errors.body_html }}
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
