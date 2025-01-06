<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';

const tableData = ref([]);

// Lifecycle
onMounted(async () => {
    try {
        const response = await fetch('/getranking');
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
        <Head title="Preferensi" />
        <div class="flex overflow-auto">
            <table class="table table-zebra table-pin-cols">
                <thead
                    class="text-lg font-bold"
                    style="background-color: hsl(0, 100%, 50%)"
                >
                    <tr>
                        <th style="width: 25%">Kriteria</th>
                        <th style="width: 25%">Nama</th>
                        <th style="width: 25%">Bobot</th>
                        <th style="width: 25%">Atribut</th>
                        <!-- <th style="width: 25%">Ranking</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A1</td>
                        <td>1</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
