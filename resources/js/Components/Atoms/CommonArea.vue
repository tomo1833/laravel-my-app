<script setup lang="ts">
const props = defineProps({
    body: String,
});
</script>

<template>
    <div
        id="education-area"
        class="p-1 bg-white grow h-full overflow-y-auto"
        v-html="props.body"
    ></div>
</template>

<style scoped>
#education-area :deep(h1),
#education-area :deep(h2),
#education-area :deep(h3),
#education-area :deep(h4),
#education-area :deep(h5),
#education-area :deep(h6) {
    margin: 20px;
    line-height: 1.2;
    font-weight: bold;
    text-align: left;
}

#education-area :deep(h1) {
    font-size: 2.5em;
    color: #2c3e50;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

#education-area :deep(h2) {
    font-size: 2em;
    color: #34495e;
    border-bottom: 2px solid #2980b9;
    padding-bottom: 8px;
}

#education-area :deep(h3) {
    font-size: 2em;
    color: #34495e;
    border-bottom: 2px solid #2980b9;
    padding-bottom: 8px;
}

#education-area :deep(h4) {
    font-size: 1.5em;
    color: #415868;
    border-left: 4px solid #2980b9;
    padding-left: 8px;
}

#education-area :deep(h5) {
    font-size: 1.25em;
    color: #2c3e50;
    background-color: #ecf0f1;
    padding: 5px 10px;
    border-radius: 4px;
}

#education-area :deep(h6) {
    font-size: 1em;
    color: #7f8c8d;
    font-style: italic;
}

#education-area :deep(p),
#education-area :deep(ul),
#education-area :deep(li),
#education-area :deep(pre) {
    text-align: left;
}

#education-area :deep(p) {
    margin: 20px;
    font-size: 1.1rem;
    color: #555;
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
