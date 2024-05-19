<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
defineProps({
    attendances: Array<object>,
});
const formatDateWithWeekdayName = (dateString: string) => {
    // Convert date string to Date object
    const date = new Date(dateString);
    // Get the weekday as a number (0-6, Sunday-Saturday)
    const weekdayNumber = date.getDay();
    // Convert weekday number to weekday name
    const weekdays = ["日", "月", "火", "水", "木", "金", "土"];
    const weekdayName = weekdays[weekdayNumber];
    // Format the output string
    const formattedDate = `${date.getDate().toString().padStart(2, "0")}（${weekdayName}）`;
    return formattedDate;
};
// 時刻をフォーマットするメソッド
const formatTime = (timeString: any) => {
    if (timeString === undefined) {
        return "-";
    }

    // 時刻文字列を Date オブジェクトに変換
    const time = new Date(timeString);
    // 時と分を取得
    const hours = time.getHours().toString().padStart(2, "0"); // 0埋めして2桁に
    const minutes = time.getMinutes().toString().padStart(2, "0"); // 0埋めして2桁に
    // 時刻を返す
    return `${hours}:${minutes}`;
};
</script>

<template>
    <Head title="勤怠管理" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                勤怠管理
            </h2>
        </template>

        <div
            v-if="$page.props.flash.status === 'sucess'"
            class="w-full p-8 bg-blue-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>

        <div
            v-if="$page.props.flash.status === 'danger'"
            class="w-full p-8 bg-red-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>

        <div class="flex items-center justify-between mb-4 bg-green-300">
            <div></div>
            <div class="px-64 py-4">
                <Link
                    as="button"
                    :href="route('attendance.create')"
                    class="bg-[#5568FE] text-white px-4 py-2 rounded"
                >
                    登録
                </Link>
            </div>
        </div>

        <div class="bg-[#FFFFFF] mx-4 my-2">
            <table
                class="w-full text-sm text-left text-gray-500 h-[500px] overflow-auto"
            >
                <thead class="text-xs text-gray-700 uppercase bg-[#F4F4F4]">
                    <tr>
                        <th scope="col" class="py-3 px-6">日付</th>
                        <th scope="col" class="py-3 px-6">出勤時間</th>
                        <th scope="col" class="py-3 px-6">退勤時間</th>
                        <th scope="col" class="py-3 px-6">休憩時間</th>
                        <th scope="col" class="py-3 px-6">勤務時間</th>
                        <th scope="col" class="py-3 px-6">メモ</th>
                        <th scope="col" class="py-3 px-6">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(attendance, date) in attendances"
                        class="bg-white border-b"
                    >
                        <td class="py-4 px-6">
                            {{ formatDateWithWeekdayName(date) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ formatTime(attendance?.check_in) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ formatTime(attendance?.check_out) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ attendance?.rest_period }}
                        </td>
                        <td class="py-4 px-6"></td>
                        <td class="py-4 px-6">
                            {{ attendance?.memo }}
                        </td>
                        <td class="py-4 px-6 flex justify-center">
                            <Link
                                v-if="attendance?.id"
                                as="button"
                                :href="
                                    route('attendance.edit', {
                                        attendance: attendance?.id,
                                    })
                                "
                                class="bg-[#F5F5F5] text-[#394264] px-3 py-1 rounded"
                            >
                                詳細
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
