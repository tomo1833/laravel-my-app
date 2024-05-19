<script setup lang="ts">
import { ref } from "vue";
import { QuillEditor } from "@vueup/vue-quill";

const content = ref("");
</script>

<template>
    <div>
        <quill-editor v-model="content"></quill-editor>
    </div>
</template>
