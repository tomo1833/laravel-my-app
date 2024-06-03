<script setup lang="ts">
import { defineProps, defineEmits } from "vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps<{
    routePath: string;
    text: string;
}>();
</script>

<template>
    <NavLink
        :href="route(props.routePath)"
        :active="route().current(props.routePath)"
    >
        {{ props.text }}
    </NavLink>
</template>
