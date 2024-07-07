<script setup lang="ts">
import axios from 'axios';
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import FormSelect from "@/Components/Molecules/FormSelect.vue";

interface Option {
    value: string;
    label: string;
}
const props = defineProps({
    tableList: Array<Option>,
});

const selectedTable = ref<string>('');

const downloadJson = async () => {
  try {
    const response = await axios.get(`/download-json?table=${selectedTable.value}`, { responseType: 'blob' });
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', `${selectedTable.value}.json`);
    document.body.appendChild(link);
    link.click();
  } catch (error) {
    console.error('Error downloading the JSON file:', error);
  }
};
</script>

<template>
    <Head title="データ" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                データ
            </h2>
        </template>

        <div>画面表示</div>

        <FormSelect
            label="table"
            name="tableName"
            v-model="selectedTable"
            :options="tableList"
        />
        
        <button
                @click="downloadJson"
                class="mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
            >
                ダウンロード JSON
        </button>

    </AuthenticatedLayout>
</template>

