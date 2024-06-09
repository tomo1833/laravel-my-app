<script setup lang="ts">
import { defineProps } from "vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

const props = defineProps<{
    routePath: string;
    text: string;
}>();
</script>

<template>
    <ResponsiveNavLink
        :href="route(props.routePath)"
        :active="route().current(props.routePath)"
    >
        {{ props.text }}
    </ResponsiveNavLink>
</template>
