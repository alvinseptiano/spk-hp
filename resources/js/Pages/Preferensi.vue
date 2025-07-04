<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const tableData = ref(null);
const isLoading = ref(true);

const fetchItems = async () => {
    try {
        const response = await axios.get('/saw/calculate');
        tableData.value = response.data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchItems();
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Preferensi" />

        <!-- Loading State -->
        <div v-if="isLoading" class="flex h-64 items-center justify-center">
            <p>Loading data...</p>
        </div>

        <!-- Tables -->
        <div v-else>
            <h1 class="text-center text-3xl">Kriteria</h1>
            <div
                class="flex overflow-auto"
                v-if="tableData && tableData['matrix']"
            >
                <table class="table-pin-cols table">
                    <thead class="bg-base-300 text-center text-lg font-bold">
                        <tr>
                            <th style="width: 25%">Alternatif</th>
                            <th
                                v-for="(value, key) in tableData['matrix'][1]"
                                :key="key"
                                class="text-center"
                            >
                                C{{ key }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr
                            v-for="(item, index) in tableData['matrix']"
                            :key="index"
                        >
                            <td>A{{ index }}</td>
                            <td v-for="(child, key) in item" :key="key">
                                {{ child }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="text-center text-3xl">Pembobotan</h1>

            <div
                class="flex overflow-auto"
                v-if="tableData && tableData['weighted']"
            >
                <table class="table-pin-cols table">
                    <thead class="bg-base-300 text-center text-lg font-bold">
                        <tr>
                            <th style="width: 25%">Alternatif</th>
                            <th
                                v-for="(value, key) in tableData['matrix'][1]"
                                :key="key"
                                class="text-center"
                            >
                                C{{ key }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr
                            v-for="(item, index) in tableData['weighted']"
                            :key="index"
                        >
                            <td>A{{ index }}</td>
                            <td v-for="(child, key) in item" :key="key">
                                {{ parseFloat(child).toFixed(3) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="text-center text-3xl">Normalisasi</h1>
            <div
                class="flex overflow-auto"
                v-if="tableData && tableData['normalization']"
            >
                <table class="table-pin-cols table">
                    <thead class="bg-base-300 text-center text-lg font-bold">
                        <tr>
                            <th style="width: 25%">Alternatif</th>
                            <th
                                v-for="(value, key) in tableData['matrix'][1]"
                                :key="key"
                                class="text-center"
                            >
                                C{{ key }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr
                            v-for="(item, index) in tableData['normalization']"
                            :key="index"
                        >
                            <td>A{{ index }}</td>
                            <td v-for="(child, key) in item" :key="key">
                                {{ parseFloat(child).toFixed(3) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="text-center text-3xl">Ranking</h1>
            <div class="border-separate"></div>
            <div
                class="flex overflow-auto"
                v-if="tableData && tableData['ranking']"
            >
                <table class="table-pin-cols table">
                    <thead class="bg-base-300 text-center text-lg font-bold">
                        <tr>
                            <th style="width: 25%">Alternatif</th>
                            <th style="width: 25%">Nama</th>
                            <th style="width: 25%">Nilai</th>
                            <th style="width: 25%">Ranking</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr
                            v-for="(item, index) in tableData['ranking']"
                            :key="item.id"
                        >
                            <td>A{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ parseFloat(item.score).toFixed(3) }}</td>
                            <td class="font-bold">{{ item.rank }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
