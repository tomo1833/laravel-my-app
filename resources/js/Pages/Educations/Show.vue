<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from "vue";
import CommonArea from "@/Components/Atoms/CommonArea.vue";
import CommonBackLink from "@/Components/Atoms/CommonBackLink.vue";
import CommonSubmitButton from "@/Components/Atoms/CommonSubmitButton.vue";
import CommonStarRating from "@/Components/Atoms/CommonStarRating.vue";
import axios from "axios";

interface User {
    id: number;
}

const props = defineProps<{
    education: Object;
    user: User;
}>();

const understandingLevel = ref(0);

// コンポーネントがマウントされたときに評価を取得する
onMounted(async () => {
    try {
        const response = await axios.get(`/api/learning-progress`, {
            params: {
                user_id: props.user.id,
                educationId: props.education.id,
            },
        });
        understandingLevel.value = response.data.score;
    } catch (error) {
        console.error("取得エラー:", error);
    }
});

const submitUnderstanding = async () => {
    try {
        const response = await axios.post("/api/submit-understanding", {
            educationId: props.education.id,
            user_id: props.user.id,
            score: understandingLevel.value,
        });
        console.log("送信成功:", response.data);
        alert("理解度が登録されました。");
    } catch (error) {
        console.error("送信エラー:", error);
        alert("エラーが発生しました。もう一度試してください。");
    }
};
</script>

<template>
    <Head title="詳細" />

    <AuthenticatedLayout>
        <section
            class="text-gray-600 body-font py-4 relative h-[calc(100vh-68px)]"
        >
            <div
                class="sm:container px-1 sm:px-5 py-8 mx-auto relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl"
            >
                <div class="px-4">
                    <CommonBackLink routePath="education.index" />
                </div>
                <div class="px-4">
                    <form @submit.prevent="submitUnderstanding">
                        <label
                            for="understanding-level"
                            class="block text-sm font-medium text-gray-700"
                        >
                            理解度:
                        </label>
                        <CommonStarRating v-model="understandingLevel" />
                        <div class="mt-4">
                            <CommonSubmitButton text="登録" />
                        </div>
                    </form>
                </div>

                <div class="flex flex-col text-center w-full mb-12 h-full">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        {{ props.education.title }}
                    </h1>
                    <CommonArea :body="props.education.body_html" />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
