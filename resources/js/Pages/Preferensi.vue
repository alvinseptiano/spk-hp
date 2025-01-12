<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const tableData = ref([]);
const selectedMethod = ref('Metode SAW'); // Default to SAW

const fetchItems = async () => {
    try {
        const endpoint =
            selectedMethod.value === 'Metode WP'
                ? '/wp/calculate'
                : '/saw/calculate';
        const response = await axios.get(endpoint);
        tableData.value = response.data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};

// Fetch data when the selected method changes
const handleMethodChange = () => {
    fetchItems();
};

onMounted(async () => {
    handleMethodChange();
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Preferensi" />
        <div class="flex overflow-auto">
            <table class="table-pin-cols table">
                <thead class="bg-base-300 text-center text-lg font-bold">
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        <!-- Dynamically generate column headings -->
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
        <div class="flex overflow-auto">
            <table class="table-pin-cols table">
                <thead class="bg-base-300 text-center text-lg font-bold">
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        <!-- Dynamically generate column headings -->
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
        <div class="flex overflow-auto">
            <table class="table-pin-cols table">
                <thead class="bg-base-300 text-center text-lg font-bold">
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        <!-- Dynamically generate column headings -->
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

        <div class="flex overflow-auto">
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
    </AuthenticatedLayout>
</template>
