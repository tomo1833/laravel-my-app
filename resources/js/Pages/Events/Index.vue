<script setup lang="ts">
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// プロパティの型を定義
interface Event {
    id: number;
    title: string;
    start: string;
    end?: string;
    is_public: boolean;
}

interface User {
    id: number;
}

// definePropsを使用してプロパティを取得
const props = defineProps<{
    events: Event[];
    user: User;
}>();

// フォームの状態を管理するリファレンスを作成
const title = ref<string>("");
const start = ref<string>("");
const end = ref<string>("");
const isPublic = ref<boolean>(false);
const showEventModal = ref<boolean>(false);
const showDetailModal = ref<boolean>(false);
const selectedEvent = ref<Event | null>(null);

// 日付クリックハンドラー
const handleDateClick = (info: DateClickArg) => {
    start.value = info.dateStr;
    showEventModal.value = true;
};

// イベントクリックハンドラー
const handleEventClick = (info: any) => {
    selectedEvent.value = {
        id: info.event.id,
        title: info.event.title,
        start: info.event.startStr,
        end: info.event.endStr,
        is_public: info.event.extendedProps.is_public,
    };
    showDetailModal.value = true;
};

// フォーム送信ハンドラー
const submit = async () => {
    await axios.post("/events", {
        title: title.value,
        start: start.value,
        end: end.value,
        is_public: isPublic.value,
    });

    window.location.reload();
};

// モーダルを閉じるハンドラー
const closeEventModal = () => {
    showEventModal.value = false;
    title.value = "";
    start.value = "";
    end.value = "";
    isPublic.value = false;
};

const closeDetailModal = () => {
    showDetailModal.value = false;
};

// カレンダーオプション
const calendarOptions = {
    locale: "ja",
    plugins: [
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin, // needed for dateClick
    ],
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    editable: true,
    selectable: true,
    initialView: "dayGridMonth",
    eventClick: handleEventClick,
    editable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    select: handleDateClick,
    events: props.events, // イベントデータを設定
};

const events = computed(() => {
    return props.events.map((event) => ({
        id: event.id,
        title: event.title,
        start: event.start,
        end: event.end,
        extendedProps: {
            is_public: event.is_public,
        },
    }));
});
</script>

<style scoped>
/* TailwindCSSスタイルを適用 */
.fixed.inset-0 {
    background: rgba(0, 0, 0, 0.5);
}
.fc .fc-timegrid-slot {
    height: 100px;
}
</style>

<template>
    <Head title="アニメ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                スケジュール
            </h2>
        </template>

        <div class="p-20">
            <div class="p-4 bg-white">
                <FullCalendar
                    :events="events"
                    :options="calendarOptions"
                    @dateClick="handleDateClick"
                    @eventClick="handleEventClick"
                />
            </div>

            <!-- イベント登録用モーダルウィンドウ -->
            <div
                v-if="showEventModal"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">イベント登録</h2>
                    <form @submit.prevent="submit">
                        <input
                            v-model="title"
                            type="text"
                            placeholder="イベント名"
                        />
                        <input
                            v-model="start"
                            type="datetime-local"
                            placeholder="開始日時"
                        />
                        <input
                            v-model="end"
                            type="datetime-local"
                            placeholder="終了日時"
                        />
                        <label>
                            <input v-model="isPublic" type="checkbox" /> 公開
                        </label>
                        <button
                            type="submit"
                            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded"
                        >
                            追加
                        </button>
                        <button
                            @click="closeEventModal"
                            class="mt-4 px-4 py-2 bg-gray-500 text-white rounded"
                        >
                            キャンセル
                        </button>
                    </form>
                </div>
            </div>

            <!-- イベント詳細表示用モーダルウィンドウ -->
            <div
                v-if="showDetailModal"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">イベント詳細</h2>
                    <p><strong>タイトル:</strong> {{ selectedEvent?.title }}</p>
                    <p><strong>開始日時:</strong> {{ selectedEvent?.start }}</p>
                    <p><strong>終了日時:</strong> {{ selectedEvent?.end }}</p>
                    <p>
                        <strong>公開:</strong>
                        {{ selectedEvent?.is_public ? "はい" : "いいえ" }}
                    </p>
                    <button
                        @click="closeDetailModal"
                        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded"
                    >
                        閉じる
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
