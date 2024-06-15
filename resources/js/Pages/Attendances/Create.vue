<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive } from "vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";

const form = useForm("post", "/attendance", {
    id: null,
    user_id: null,
    date: null,
    check_in: null,
    check_out: null,
    rest_period: null,
    memo: null,
});

const storeAttendence = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="勤怠登録" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="storeAttendence">
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <div class="flex flex-col text-center w-full mb-12">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            勤怠登録
                        </h1>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">日付</label>
                        <input
                            type="date"
                            name="date"
                            v-model="form.date"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('date')" class="text-red-500">
                            {{ form.errors.date }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">出勤時間</label>
                        <input
                            type="time"
                            name="check_in"
                            v-model="form.check_in"
                            class="p-2 border rounded w-full"
                        />
                        <div
                            v-if="form.invalid('check_in')"
                            class="text-red-500"
                        >
                            {{ form.errors.check_in }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">退勤時間</label>
                        <input
                            type="time"
                            name="check_out"
                            v-model="form.check_out"
                            class="p-2 border rounded w-full"
                        />
                        <div
                            v-if="form.invalid('check_out')"
                            class="text-red-500"
                        >
                            {{ form.errors.check_out }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">休憩時間</label>
                        <input
                            type="text"
                            name="rest_period"
                            v-model="form.rest_period"
                            class="p-2 border rounded w-full"
                        />
                        <div
                            v-if="form.invalid('rest_period')"
                            class="text-red-500"
                        >
                            {{ form.errors.rest_period }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">メモ</label>
                        <input
                            type="text"
                            name="memo"
                            v-model="form.memo"
                            class="p-2 border rounded w-full"
                        />
                        <div v-if="form.invalid('memo')" class="text-red-500">
                            {{ form.errors.memo }}
                        </div>
                    </div>
                    <CommonSubmitButton text="登録" />
                </div>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
