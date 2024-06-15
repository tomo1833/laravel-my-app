<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import { QuillEditor } from "@vueup/vue-quill";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";

const props = defineProps({
    education: Object,
});

const form = useForm("put", "/education/" + props.education.id, {
    id: props.education.id,
    title: props.education.title,
    body: props.education.body,
    body_html: props.education.body_html,
    order: props.education.order,
    large_kbn: props.education.large_kbn,
    middle_kbn: props.education.middle_kbn,
    small_kbn: props.education.small_kbn,
});

const updateEduation = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteEducation = (id) => {
    Inertia.delete(route("education.destroy", { attendance: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};

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
</script>

<template>
    <Head title="教育ページ更新" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateEduation">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
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
                    <div class="flex flex-row">
                        <button
                            type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            更新
                        </button>
                        <button
                            type="button"
                            @click="deleteEducation(form.id)"
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
