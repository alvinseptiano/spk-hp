<!-- <script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const scoreData = ref([]);
const criteriaData = ref([]);
const subcriteriaData = ref([]);
const selectedAlternative = ref(null);
const selectedCriterion = ref(null);
const showPhone = ref(false);

const fetchItems = async () => {
    try {
        const response = await axios.get(`/getdata`);
        tableData.value = response.data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};
const getSubcriteria = (criterionId) => {
    return subcriteriaData.value.filter(
        (sub) => sub.criteria_id === criterionId,
    );
};

const getValue = (alternativeId, criteriaId) => {
    const score = scoreData.value.find(
        (s) =>
            s.alternative_id === alternativeId && s.criteria_id === criteriaId,
    );
    return score ? score.value : 'ss';
};

onMounted(() => {
    fetchItems;
});
</script> -->

<script setup>
import { ref, onMounted } from 'vue';
import AccentButton from '@/Components/AccentButton.vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/solid';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import TopBar from '@/Components/TopBar.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';

const criteriaData = ref([]);
const subcriteriaData = ref([]);
const selectedValues = ref({});
const showPhone = ref(false);
const recommendedPhone = ref('');

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
        criteriaData.value = response.data.data.criteria;
        subcriteriaData.value = response.data.data.subcriteria;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};

const getSubcriteria = (criterionId) => {
    return subcriteriaData.value.filter(
        (sub) => sub.criteria_id === criterionId,
    );
};

const saveValue = async () => {
    showPhone.value = true;
    console.log(selectedValues.value);
    // Add your recommendation logic here
    // recommendedPhone.value = result of your recommendation calculation
};
</script>

<template>
    <!-- <AuthenticatedLayout> -->
    <Head title="Rekomendasi" />
    <TopBar />
    <div class="flex h-screen max-h-[90vh] flex-col px-52 bg-base-300 h-full">
        <div class="mt-10">
            <h3 class="mb-4 text-center text-lg font-bold">
                Pilih Kriteria Smartphone
            </h3>
            <div class="space-y-4">
                <div
                    v-for="criterion in criteriaData"
                    :key="criterion.id"
                    class="form-control"
                >
                    <label class="label">
                        <span class="label-text">{{ criterion.name }}</span>
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
        </div>
        <div class="modal-action mt-6 justify-center">

            <InertiaLink href="/home">
                <AccentButton>
                    <ArrowLeftIcon class="size-5" />
                    Kembali</AccentButton
                >
            </InertiaLink>
            <button class="btn btn-primary" @click="saveValue">
                Rekomendasikan
            </button>
        </div>
        <div v-if="showPhone" class="justify-center">
            <div class="mockup-phone scale-50">
                <div class="mockup-phone-camera"></div>

                <div
                    class="mockup-phone-display grid place-content-center text-center text-3xl text-white"
                >
                    Rekomendasi Smartphone anda adalah
                    {{ recommendedPhone }}
                </div>
            </div>
        </div>
    </div>
    <!-- </AuthenticatedLayout> -->
</template>
