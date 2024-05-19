<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive } from "vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "laravel-precognition-vue-inertia";

const props = defineProps({
    attendance: Object,
});

// 時間データをHH:mm形式に変換するヘルパー関数
const formatTime = (timeString) => {
    if (!timeString) return null;
    const time = new Date(timeString);
    return time.toLocaleTimeString("en-GB", {
        hour: "2-digit",
        minute: "2-digit",
    });
};

const form = useForm("put", "/attendance/" + props.attendance.id, {
    id: props.attendance.id,
    user_id: props.attendance.user_id,
    date: props.attendance.date,
    check_in: formatTime(props.attendance.check_in),
    check_out: formatTime(props.attendance.check_out),
    rest_period: props.attendance.rest_period,
    memo: props.attendance.memo,
});

const updateAttendance = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const deleteAttendance = (id) => {
    Inertia.delete(route("attendance.destroy", { attendance: id }), {
        onBefore: () => confirm("削除しますか？"),
    });
};
</script>

<template>
    <Head title="勤怠編集" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font py-24 relative">
            <form @submit.prevent="updateAttendance()">
                <div class="container px-5 py-8 mx-auto bg-white">
                    <div class="flex flex-col text-center w-full mb-12">
                        <h1
                            class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                        >
                            勤怠編集
                        </h1>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">日付</label>
                        <input
                            type="date"
                            name="date"
                            v-model="form.date"
                            class="p-2 border rounded w-full"
                            disabled="disabled"
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
                    <div class="flex flex-row">
                        <button
                            type="submit"
                            class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            更新
                        </button>
                        <button
                            type="button"
                            @click="deleteAttendance(form.id)"
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
