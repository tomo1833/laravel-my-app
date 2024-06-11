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
#education-area :deep(h1) {
    font-size: 32px;
    padding: 0.5em;
    color: #494949;
    background: #fffaf4;
    border-left: solid 5px #ffaf58;
}
#education-area :deep(h2) {
    font-size: 24px;
}
#education-area :deep(h3) {
    font-size: 16px;
}
#education-area :deep(h1),
#education-area :deep(h2),
#education-area :deep(h3),
#education-area :deep(p),
#education-area :deep(ul),
#education-area :deep(li),
#education-area :deep(pre) {
    text-align: left;
}

#education-area :deep(ul li::marker) {
    font-size: 100%;
}

#education-area :deep(pre) {
    background-color: #23241f;
    color: #f8f8f2;
    overflow: visible;
    white-space: pre-wrap;
    margin-bottom: 5px;
    margin-top: 5px;
    padding: 5px 10px;
}
</style>
