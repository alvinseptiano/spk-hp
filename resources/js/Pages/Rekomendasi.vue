<script setup>
import { ref, computed, onMounted } from 'vue';
import AccentButton from '@/Components/AccentButton.vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import TopBar from '@/Components/TopBar.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';

const criteriaData = ref([]);
const subcriteriaData = ref([]);
const alternativesData = ref([]);
const scoresData = ref([]);
const selectedValues = ref({});
const recommendedPhone = ref([]);
const recommendationSection = ref(null);

// New: Define searchType and price inputs
const searchType = ref('Harga');

onMounted(async () => {
    try {
        await fetchItems();
    } catch (error) {
        console.error('Error fetching items:', error);
    }
});

const fetchItems = async () => {
    try {
        const response = await axios.get('/getdata');
        const data = response.data.data;

        criteriaData.value = data.criteria;
        subcriteriaData.value = data.subcriteria;
        alternativesData.value = data.alternative;
        scoresData.value = data.score;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};

const getSubcriteria = (criterionId) => {
    return subcriteriaData.value.filter(
        (sub) => sub.criteria_id === criterionId,
    );
};

// Computed property to filter out "test"
const filteredCriteria = computed(() => {
    return criteriaData.value.filter(
        (criterion) => criterion.name?.toLowerCase() !== 'harga',
    );
});
const saveValue = async () => {
    // Ensure criteria are selected
    const activeCriteria = Object.keys(selectedValues.value).filter(
        (criterionId) => selectedValues.value[criterionId],
    );

    if (activeCriteria.length === 0) {
        recommendedPhone.value = ['Silakan pilih kriteria terlebih dahulu'];
        return;
    }

    let filteredAlternatives = alternativesData.value.filter((alternative) => {
        return activeCriteria.every((criterionId) => {
            const selectedValue = selectedValues.value[criterionId];
            const score = scoresData.value.find(
                (s) =>
                    s.alternative_id === alternative.id &&
                    s.criteria_id === parseInt(criterionId, 10),
            );
            return score && score.value === selectedValue;
        });
    });

    // Store all matching phones in an array
    recommendedPhone.value =
        filteredAlternatives.length > 0
            ? filteredAlternatives.map((alt) => alt.name)
            : ['Tidak ada smartphone yang cocok dengan kriteria Anda.'];

    // Scroll to recommendation section
    if (recommendationSection.value) {
        recommendationSection.value.scrollIntoView({ behavior: 'smooth' });
    }
};

const clearSelection = () => {
    Object.keys(selectedValues.value).forEach((key) => {
        selectedValues.value[key] = ''; // Reset each dropdown to empty
    });
};
</script>

<template>
    <Head :title="'Rekomendasi'" />
    <TopBar />

    <div class="bg-base-300 min-h-screen px-4 py-10">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-col gap-6 lg:flex-row">
                <!-- Left: Criteria Selection -->
                <div
                    class="bg-base-300 w-full rounded-lg p-6 shadow-lg lg:w-1/2"
                >
                    <h3 class="mb-6 text-center text-xl font-bold">
                        Pilih Kriteria Smartphone
                    </h3>

                    <h4 class="mb-4 text-xl font-bold">Jenis Pencarian:</h4>

                    <select
                        v-model="searchType"
                        class="select mb-10 w-full"
                        name="searchType"
                    >
                        <option value="Harga">Harga</option>
                        <option value="Spesifikasi">Spesifikasi</option>
                    </select>

                    <div
                        class="form-control space-y-4"
                        v-if="searchType === 'Harga'"
                    >
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ Harga }}</span>
                            </label>
                            <select
                                v-model="selectedValues[1]"
                                class="select select-bordered w-full"
                            >
                                <option value="" disabled>
                                    Select {{ Harga }}
                                </option>
                                <option
                                    v-for="sub in getSubcriteria(1)"
                                    :key="sub.id"
                                    :value="sub.value"
                                >
                                    {{ sub.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4" v-if="searchType === 'Spesifikasi'">
                        <div
                            v-for="criterion in filteredCriteria"
                            :key="criterion.id"
                            class="form-control"
                        >
                            <label class="label">
                                <span class="label-text">{{
                                    criterion.name
                                }}</span>
                            </label>
                            <select
                                v-model="selectedValues[criterion.id]"
                                class="select select-bordered w-full"
                            >
                                <option value="" disabled>
                                    Select {{ criterion.name }}
                                </option>
                                <option
                                    v-for="sub in getSubcriteria(criterion.id)"
                                    :key="sub.id"
                                    :value="sub.value"
                                >
                                    {{ sub.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-center gap-4">
                        <InertiaLink href="/home">
                            <AccentButton class="flex items-center gap-2">
                                <ArrowLeftIcon class="h-5 w-5" />
                                Kembali
                            </AccentButton>
                        </InertiaLink>
                        <button
                            class="btn btn-secondary"
                            @click="clearSelection"
                        >
                            Kosongkan Pilihan
                        </button>
                        <button class="btn btn-primary" @click="saveValue">
                            Rekomendasikan
                        </button>
                    </div>
                </div>

                <!-- Right: Search Results -->
                <div
                    class="bg-base-100 w-full rounded-lg p-6 shadow-lg lg:w-1/2"
                >
                    <h3 class="mb-4 text-xl font-bold">Hasil Pencarian</h3>
                    <ul v-if="recommendedPhone.length > 0">
                        <li
                            v-for="phone in recommendedPhone"
                            :key="phone"
                            class="border-b border-gray-300 p-2"
                        >
                            {{ phone }}
                        </li>
                    </ul>
                    <p v-else class="text-gray-500">
                        Tidak ada hasil ditemukan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
