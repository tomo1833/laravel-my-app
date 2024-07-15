<script setup lang="ts">
import { useForm } from "laravel-precognition-vue-inertia";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonTitle from "@/Components/Atoms/CommonTitle.vue";

import FormText from "@/Components/Molecules/FormText.vue";


const props = defineProps({
});

/**
 * フォームの初期値を設定し、送信時の処理を定義
 */
const form = useForm("post", "/user", {
    name: null,
    email: null,
});


/**
 * フォームを送信する処理
 */
 const storeUser = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>

        <section class="text-gray-600 body-font py-24 relative">

            <form @submit.prevent="storeUser">

                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >

                    <!-- 戻る -->
                    <div class="pb-10">
                        <CommonBackLink
                            routePath="user.index"
                            text="戻る"
                            styleType="primary"
                        />
                    </div>

                    <!-- ユーザ -->
                    <CommonTitle title="ユーザ" />

                    <FormText
                        label="名前"
                        name="name"
                        v-model:modelValue="form.name"
                        :error="form.invalid('name') ? form.errors.name : ''"
                    />
                    
                    <FormText
                        label="email"
                        name="email"
                        v-model:modelValue="form.email"
                        :error="form.invalid('email') ? form.errors.email : ''"
                    />

                    <!-- 登録ボタン　-->                    
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