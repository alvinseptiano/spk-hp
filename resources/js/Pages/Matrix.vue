<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';

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
        <Head title="Dashboard" />
        <div class="mt-6 flex flex-col gap-4">
            <div class="rounded-lg bg-base-100">
                <div class="overflow-auto">
                    <!-- <div class="mockup-phone">
                        <div class="camera"></div>
                        <div class="display">
                            <div
                                class="artboard artboard-demo phone-1 text-center text-3xl font-bold"
                            >
                                Rekomendasi smartphone anda adalah Xiaomi
                            </div>
                        </div>
                    </div> -->
                    <table class="table table-pin-rows table-sm z-10 w-full">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    <label>
                                        <input
                                            type="checkbox"
                                            class="checkbox"
                                        />
                                    </label>
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 20.5%"
                                >
                                    Nama
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    Harga
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    Prosesor
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    RAM
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    Internal
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    Resolusi
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 13.5%"
                                >
                                    Baterai
                                </th>
                                <th
                                    class="py-3 text-left text-xs font-medium uppercase"
                                    style="width: 7%"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rest of the code remains the same -->
                            <tr
                                v-for="item in tableData"
                                :key="item.id_hp"
                                class="hover bg-base-200"
                            >
                                <td>
                                    <label>
                                        <input
                                            type="checkbox"
                                            class="checkbox"
                                        />
                                    </label>
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.nama }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.harga }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.prosesor }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.ram }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.kamera }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.resolusi }}
                                </td>
                                <td class="py-4 text-sm">
                                    {{ item.baterai }}
                                </td>
                                <td class="py-4 text-sm">
                                    <div class="dropdown dropdown-end">
                                        <button
                                            tabindex="0"
                                            class="pi pi-ellipsis-v"
                                        ></button>
                                        <ul
                                            tabindex="0"
                                            class="menu dropdown-content rounded-box bg-base-200 p-2 shadow"
                                        >
                                            <li>
                                                <button
                                                    @click="
                                                        downloadFile(item.path)
                                                    "
                                                    v-if="item.is_file"
                                                >
                                                    Download
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    @click="deleteItem(item)"
                                                    class="text-error"
                                                >
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
