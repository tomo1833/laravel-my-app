<script setup lang="ts">
const props = defineProps({
    body: String,
});
</script>

<template>
    <div
        id="education-area"
        class="p-8 bg-white grow h-full overflow-y-auto"
        v-html="props.body"
    ></div>
</template>

<style scoped>
#education-area ::v-deep h1 {
    font-size: 32px;
}
#education-area ::v-deep h1,
#education-area ::v-deep p {
    text-align: left;
}
</style>
