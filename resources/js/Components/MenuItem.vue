<script setup>
import { Link as InertiaLink } from '@inertiajs/vue3';
defineProps({
    icon: {
        type: Object,
        required: true,
    },
    isOpen: { type: Boolean },
    link: { type: String },
    name: { type: String, required: true },
});
const isActive = (path) => {
    return window.location.pathname === path;
};
</script>

<template>
    <li>
        <InertiaLink
            :href="`/${link}`"
            :class="[
                'relative flex items-center py-4',
                {
                    'bg-primary/10': isActive(`/${link}`),
                },
                !isOpen && 'justify-center',
            ]"
        >
            <div
                v-if="isActive(`/${link}`)"
                class="absolute left-0 top-0 h-full w-1 bg-primary"
            ></div>
            <component
                :is="icon"
                :class="[
                    'size-5',
                    {
                        'text-primary': isActive(`/${link}`),
                    },
                ]"
            />
            <span :class="['ml-2', !isOpen && 'hidden']">{{ name }}</span>
        </InertiaLink>
    </li>
</template>
