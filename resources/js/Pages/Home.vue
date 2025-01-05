<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { Line } from 'vue-chartjs';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js';

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
);

const currentTheme = ref(localStorage.getItem('theme') || 'nord');

const chartData = ref({
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [
        {
            label: 'Sample Data',
            backgroundColor: 'rgba(147, 51, 234, 0.2)', // Solid purple with opacity
            borderColor: '#9333EA', // Solid purple
            borderWidth: 2,
            tension: 0.4,
            data: [40, 20, 12, 39, 10, 30],
        },
    ],
});

const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: '#1F2937', // Dark gray for text
            },
        },
    },
    scales: {
        x: {
            grid: {
                color: 'rgba(31, 41, 55, 0.1)', // Dark gray with opacity for grid
            },
            ticks: {
                color: '#1F2937', // Dark gray for text
            },
        },
        y: {
            grid: {
                color: 'rgba(31, 41, 55, 0.1)', // Dark gray with opacity for grid
            },
            ticks: {
                color: '#1F2937', // Dark gray for text
            },
        },
    },
});

// Update chart when theme changes
watch(
    () => localStorage.getItem('theme'),
    (newTheme) => {
        if (newTheme !== currentTheme.value) {
            currentTheme.value = newTheme;
            chartData.value = { ...chartData.value };
        }
    },
);

onMounted(() => {
    chartData.value = { ...chartData.value };
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />
        <div class="mt-6 flex flex-col gap-4">
            <div class="chart-container w-full justify-center">
                <Line :data="chartData" :options="chartOptions" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
