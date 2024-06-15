<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

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

const toolbarOptions = [
    ["bold", "italic", "underline", "strike"], // toggled buttons
    ["blockquote", "code-block"],

    [{ header: 1 }, { header: 2 }], // custom button values
    [{ list: "ordered" }, { list: "bullet" }],
    [{ script: "sub" }, { script: "super" }], // superscript/subscript
    [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
    [{ direction: "rtl" }], // text direction

    [{ size: ["small", false, "large", "huge"] }], // custom dropdown
    [{ header: [1, 2, 3, 4, 5, 6, false] }],

    [{ color: [] }, { background: [] }], // dropdown with defaults from theme
    [{ font: [] }],
    [{ align: [] }],

    ["clean"], // remove formatting button
];

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
                    s
                    <div class="pb-10">
                        <CommonLinkButton
                            routePath="education.index"
                            text="戻る"
                            styleType="primary"
                        />
                    </div>
                    <div class="flex flex-col text-center w-full mb-12">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            教育ページ登録
                        </h1>
                    </div>
                    <div class="mb-4 flex justify-between">
                        <div>
                            <label class="block mb-2">大項目</label>
                            <input
                                type="text"
                                name="large_kbn"
                                v-model="form.large_kbn"
                                class="p-2 border rounded w-full"
                            />
                            <div
                                v-if="form.invalid('large_kbn')"
                                class="text-red-500"
                            >
                                {{ form.errors.large_kbn }}
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2">中項目</label>
                            <input
                                type="text"
                                name="middle_kbn"
                                v-model="form.middle_kbn"
                                class="p-2 border rounded w-full"
                            />
                            <div
                                v-if="form.invalid('middle_kbn')"
                                class="text-red-500"
                            >
                                {{ form.errors.middle_kbn }}
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2">小項目</label>
                            <input
                                type="text"
                                name="small_kbn"
                                v-model="form.small_kbn"
                                class="p-2 border rounded w-full"
                            />
                            <div
                                v-if="form.invalid('small_kbn')"
                                class="text-red-500"
                            >
                                {{ form.errors.small_kbn }}
                            </div>
                        </div>
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
                        <QuillEditor
                            theme="snow"
                            v-model:content="form.body_html"
                            contentType="html"
                            :toolbar="toolbarOptions"
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
