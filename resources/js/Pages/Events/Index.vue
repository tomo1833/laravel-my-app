<script setup lang="ts">
import { ref, computed, watch } from "vue";
import { defineProps } from "vue";
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
const handleDateClick = (info: any) => {
    start.value = removeTimezone(info.dateStr);
    showEventModal.value = true;
};

// イベントクリックハンドラー
const handleEventClick = (info: any) => {
    selectedEvent.value = {
        id: info.event.id,
        title: info.event.title,
        start: removeTimezone(info.event.startStr),
        end: info.event.endStr ? removeTimezone(info.event.endStr) : "",
        is_public: info.event.extendedProps.is_public,
    };
    title.value = selectedEvent.value.title;
    start.value = selectedEvent.value.start;
    end.value = selectedEvent.value.end || "";
    isPublic.value = selectedEvent.value.is_public;
    showEventModal.value = true;
};

// タイムゾーン情報を削除する関数
const removeTimezone = (dateTimeString: string | null | undefined) => {
    if (!dateTimeString) return '';
    return dateTimeString.replace(/([+-]\d{2}:\d{2}|Z)$/, '');
};

// フォーム送信ハンドラー
const submit = async () => {
    const eventData = {
        title: title.value,
        start: start.value,
        end: end.value,
        is_public: isPublic.value,
    };

    if (selectedEvent.value) {
        // イベントの更新
        await axios.put(`/events/${selectedEvent.value.id}`, eventData);
    } else {
        // 新規イベントの追加
        await axios.post("/events", eventData);
    }
    window.location.reload();
};

// イベント削除ハンドラー
const deleteEvent = async () => {
    if (selectedEvent.value) {
        await axios.delete(`/events/${selectedEvent.value.id}`);
        window.location.reload();
    }
};

// モーダルを閉じるハンドラー
const closeEventModal = () => {
    showEventModal.value = false;
    title.value = "";
    start.value = "";
    end.value = "";
    isPublic.value = false;
    selectedEvent.value = null;
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
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    select: handleDateClick,
    events: props.events,
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

            <!-- イベント登録/編集用モーダルウィンドウ -->
            <div
                v-if="showEventModal"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <div
                    class="container px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
                >
                    <h2 class="text-xl font-bold mb-4">
                        {{ selectedEvent ? "イベント編集" : "イベント登録" }}
                    </h2>

                    <form @submit.prevent="submit">
                        <div class="flex flex-col">
                            <div class="mb-4">
                                <input
                                    v-model="title"
                                    type="text"
                                    placeholder="イベント名"
                                    class="p-2 border rounded w-full"
                                />
                            </div>
                            <div class="mb-4">
                                <input
                                    v-model="start"
                                    type="datetime-local"
                                    placeholder="開始日時"
                                    class="p-2 border rounded w-full"
                                />
                            </div>
                            <div class="mb-4">
                                <input
                                    v-model="end"
                                    type="datetime-local"
                                    placeholder="終了日時"
                                    class="p-2 border rounded w-full"
                                />
                            </div>
                            <div class="mb-4">
                                <label>
                                    <input v-model="isPublic" type="checkbox" />
                                    公開
                                </label>
                            </div>

                            <div class="flex flex-row justify-evenly">
                                <div>
                                    <button
                                        type="submit"
                                        class="w-32 mt-4 px-4 py-2 bg-blue-500 text-white rounded"
                                    >
                                        {{ selectedEvent ? "更新" : "追加" }}
                                    </button>
                                </div>
                                <div>
                                    <button
                                        @click="closeEventModal"
                                        class="w-32 mt-4 px-4 py-2 bg-gray-500 text-white rounded"
                                    >
                                        キャンセル
                                    </button>
                                </div>
                                <div v-if="selectedEvent">
                                    <button
                                        @click="deleteEvent"
                                        class="w-32 mt-4 px-4 py-2 bg-red-500 text-white rounded"
                                    >
                                        削除
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
