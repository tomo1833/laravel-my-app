<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonButton from "@/Components/Atoms/CommonButton.vue";

const props = defineProps<{ images: string[] }>();

const selectedFile = ref<File | null>(null);
const form = useForm({
    image: null as File | null,
});

const onFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.image = target.files[0];
    }
};

const uploadImage = () => {
    form.post(route("images.store"), {
        onSuccess: () => {
            selectedFile.value = null;
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="画像" />
    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <div class="container px-5 py-8 mx-auto bg-white">
                <h1
                    class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                >
                    画像アップロード
                </h1>
                <div class="mb-4">
                    <input type="file" @change="onFileChange" />
                    <CommonButton @click="uploadImage" text="アップロード" />
                    <div v-if="props.images.length" class="flex">
                        <div
                            v-for="image in props.images"
                            :key="image"
                            class="p-4"
                        >
                            <img
                                :src="`/images/${image}`"
                                :alt="image"
                                width="200"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
