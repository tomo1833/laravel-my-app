<script lang="ts">
import { defineComponent, ref, watch } from "vue";

export default defineComponent({
    props: {
        modelValue: {
            type: Number,
            required: true,
        },
    },
    emits: ["update:modelValue"],
    setup(props, { emit }) {
        const rating = ref(props.modelValue);

        watch(
            () => props.modelValue,
            (newValue) => {
                rating.value = newValue;
            },
        );

        const setRating = (star: number) => {
            rating.value = star;
            emit("update:modelValue", star);
        };

        return {
            rating,
            setRating,
        };
    },
});
</script>

<template>
    <div class="star-rating flex">
        <span v-for="star in 10" :key="star" @click="setRating(star)">
            <svg
                :class="{
                    'text-yellow-400': star <= rating,
                    'text-gray-300': star > rating,
                }"
                class="h-6 w-6 cursor-pointer"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.562 4.779a1 1 0 00.95.69h5.017c.969 0 1.371 1.24.588 1.81l-4.06 2.944a1 1 0 00-.364 1.118l1.562 4.779c.3.921-.755 1.688-1.538 1.118l-4.06-2.944a1 1 0 00-1.176 0l-4.06 2.944c-.783.57-1.837-.197-1.538-1.118l1.562-4.779a1 1 0 00-.364-1.118L2.93 10.206c-.783-.57-.38-1.81.588-1.81h5.017a1 1 0 00.95-.69l1.562-4.779z"
                />
            </svg>
        </span>
    </div>
</template>

<style scoped>
.star-rating svg {
    transition: color 0.2s ease;
}
</style>
