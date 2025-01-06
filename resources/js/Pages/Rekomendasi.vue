<script setup>
import axios from 'axios';
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

onMounted(() => {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (token) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Rekomendasi" />
        <div class="flex h-full flex-col">
            <div role="tablist" class="tabs tabs-lifted">
                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Tab 1"
                    style="outline: none"
                />
                <div
                    role="tabpanel"
                    style="outline: none"
                    class="tab-content rounded-box border-base-300 bg-base-100 p-6"
                >
                    Tab content 1
                </div>

                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Tab 2"
                    checked="checked"
                />
                <div
                    role="tabpanel"
                    class="tab-content rounded-box border-base-300 bg-base-100 p-6"
                >
                    Tab content 2
                </div>

                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Tab 3"
                />
                <div
                    role="tabpanel"
                    class="tab-content rounded-box border-base-300 bg-base-100 p-6"
                >
                    Tab content 3
                </div>
            </div>
            <div class="w-32">
                <div class="mockup-phone">
                    <div class="camera"></div>
                    <div class="display">
                        <div
                            class="artboard artboard-demo phone-1 text-center text-3xl font-bold"
                        >
                            Rekomendasi smartphone anda adalah Xiaomi
                        </div>
                    </div>
                </div>
                <PrimaryButton>Hello</PrimaryButton>
                <TextInput />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.checkbox {
    visibility: hidden;
    outline: none;
    background-color: red;
}
.tab {
    z-index: 10;
    outline: none;
}
</style>
