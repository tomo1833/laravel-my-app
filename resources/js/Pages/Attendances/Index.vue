<script setup lang="ts">
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CommonLinkButton from "@/Components/Atoms/CommonLinkButton.vue";
import CommonButton from "@/Components/Atoms/CommonButton.vue";

interface Attendance {
    check_in: string | null;
    check_out: string | null;
    rest_period: string | null;
    memo: string | null;
    id: number | null;
}

/**
 * プロパティの定義
 * @type {{ attendances: Attendance[] }}
 * @property {Attendance[]} attendances - 出勤情報の配列
 */
const props = defineProps({
    attendances: Array<Attendance>,
    year: Number,
    month: Number,
});

const searchYearMonth = ref<String>(
    `${props.year.toString()}-${props.month.toString().padStart(2, "0")}`,
);

/**
 * 日付文字列を受け取り、曜日の名前を含むフォーマットされた日付文字列を返します。
 *
 * @param {string} dateString - 日付を表す文字列。
 * @returns {string} 曜日の名前を含むフォーマットされた日付文字列。
 */
const formatDateWithWeekdayName = (dateString: string): string => {
    // 日付文字列をDateオブジェクトに変換
    const date = new Date(dateString);
    // 曜日を数値で取得 (0-6, 日曜日-土曜日)
    const weekdayNumber = date.getDay();
    // 曜日番号を曜日名に変換
    const weekdays = ["日", "月", "火", "水", "木", "金", "土"];
    const weekdayName = weekdays[weekdayNumber];
    // 出力文字列をフォーマット
    const formattedDate = `${date.getDate().toString().padStart(2, "0")}（${weekdayName}）`;

    return formattedDate;
};

/**
 * 時刻文字列を受け取り、フォーマットされた時刻文字列を返します。
 *
 * @param {any} timeString - 時刻を表す文字列またはその他の形式の入力。
 * @returns {string} フォーマットされた時刻文字列。入力が未定義の場合は"-"を返します。
 */
const formatTime = (timeString: any): string => {
    if (timeString === undefined) {
        return "-";
    }

    // 時刻文字列をDateオブジェクトに変換
    const time = new Date(timeString);
    // 時と分を取得 0埋めして2桁
    const hours = time.getHours().toString().padStart(2, "0");
    const minutes = time.getMinutes().toString().padStart(2, "0");

    return `${hours}:${minutes}`;
};

// 検索処理を実行する関数
const search = () => {
    console.log("--log.log");

    // ここに検索処理を実装します
    const [year, month] = searchYearMonth.value.split("-").map(Number);
    console.log("---hoge");
    console.log(year);
    console.log(month);
    Inertia.get("/attendance", { year: year, month: month });
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
            v-if="$page.props.flash.status === 'create'"
            class="w-full p-8 bg-blue-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>

        <div
            v-if="$page.props.flash.status === 'delete'"
            class="w-full p-8 bg-red-300 text-white"
        >
            {{ $page.props.flash.message }}
        </div>

        <!-- リスト ナビ -->
        <div class="flex items-center justify-around py-2 bg-green-300">
            <div class="flex">
                <div
                    class="relative mr-4 lg:w-full xl:w-1/2 w-2/4 md:w-full text-left"
                >
                    <label
                        for="search-month"
                        class="leading-7 text-sm text-gray-600"
                        >年月</label
                    >
                    <input
                        type="month"
                        id="search-month"
                        name="searchYearMonth"
                        v-model="searchYearMonth"
                        class="w-40 bg-withe bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                    />
                </div>
                <div class="pt-7">
                    <CommonButton @clickEvent="search" text="検索" />
                </div>
            </div>

            <div class="px-64 py-4">
                <CommonLinkButton
                    routePath="attendance.create"
                    text="登録"
                    styleType="primary"
                />
            </div>
        </div>

        <!-- リスト -->
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
