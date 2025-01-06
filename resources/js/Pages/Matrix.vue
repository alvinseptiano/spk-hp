<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';
// Refs
const tableData = ref([]);

// Lifecycle
onMounted(async () => {
    try {
        const response = await fetch('/getsmartphone');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        tableData.value = await response.json();
        console.log('Response:', tableData.value); // Debug log
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Data Matrik" />
        <div class="flex flex-col gap-4">
            <div class="relative h-[calc(100vh-100px)] overflow-auto">
                <table class="table table-pin-cols table-xs w-full">
                    <thead>
                        <tr>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Nama
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Harga
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Prosesor
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                RAM
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Internal
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Resolusi
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Baterai
                            </th>
                            <th
                                class="py-3 text-left text-xs font-medium uppercase"
                            >
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="item in tableData"
                            :key="item.id_hp"
                            class="hover bg-base-200"
                        >
                            <th class="py-4 text-sm">
                                {{ item.name }}
                            </th>
                            <th class="py-4 text-sm">
                                {{
                                    new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                    }).format(item.price)
                                }}
                            </th>
                            <th class="py-4 text-sm">
                                {{ item.processor }}
                            </th>
                            <th class="py-4 text-sm">
                                {{ item.ram }}
                            </th>
                            <th class="py-4 text-sm">
                                {{ item.camera }}
                            </th>
                            <th class="py-4 text-sm">
                                {{ item.screen }}
                            </th>
                            <th class="py-4 text-sm">
                                {{ item.battery }}
                            </th>
                            <th class="py-4 text-sm">
                                <button
                                    class="btn btn-ghost btn-sm"
                                    @click="handleDelete"
                                >
                                    <PencilSquareIcon class="size-5" />
                                </button>
                                <button
                                    class="btn btn-ghost btn-sm"
                                    @click="handleDelete"
                                >
                                    <TrashIcon class="size-5 text-error" />
                                </button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
