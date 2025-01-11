<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const tableData = ref([]);

const fetchItems = async () => {
    try {
        const response = await axios.get(`/saw/calculate`);
        tableData.value = response.data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};

onMounted(() => {
    fetchItems();
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
