<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import axios from 'axios';

const tableData = ref({}); // Initialize as an empty object
const selectedAlternative = ref(null);
const selectedCriterion = ref(null);
const selectedValue = ref('');
const values = ref({});

const scoreData = ref([]);
const criteriaData = ref([]);
const alternativeData = ref([]);
const subcriteriaData = ref([]);

onMounted(async () => {
    try {
        await fetchItems();
    } catch (error) {
        console.error('Error fetching items:', error);
    }
});

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

const openModal = (alternative, criterion) => {
    selectedAlternative.value = alternative;
    selectedCriterion.value = criterion;
    selectedValue.value = getValue(alternative.id, criterion.id) || '';
    document.getElementById('criterion_modal').showModal();
};

const closeModal = () => {
    document.getElementById('criterion_modal').close();
    resetModal();
};

const resetModal = () => {
    selectedAlternative.value = null;
    selectedCriterion.value = null;
    selectedValue.value = '';
};

const saveValue = async () => {
    if (!selectedAlternative.value || !selectedCriterion.value) return;

    if (!values.value[selectedAlternative.value.id]) {
        values.value[selectedAlternative.value.id] = {};
    }

    values.value[selectedAlternative.value.id][selectedCriterion.value.id] =
        selectedValue.value;

    try {
        await axios.post('/addscore', {
            alternative_id: selectedAlternative.value.id,
            criteria_id: selectedCriterion.value.id,
            value: selectedValue.value,
        });

        // Refresh table data
        await fetchItems();
        closeModal();
    } catch (error) {
        console.error('Error saving value:', error);
    }
};

const fetchItems = async () => {
    try {
        const dataResponse = await axios.get('/getdata');

        tableData.value = dataResponse.data.data;
        criteriaData.value = tableData.value.criteria;
        alternativeData.value = tableData.value.alternative;
        subcriteriaData.value = tableData.value.subcriteria;
        scoreData.value = tableData.value.score;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Preferensi" />
        <FlashMessage :show="showToast" :message="toastMessage" />
        <table class="table-pin-cols table w-full">
            <thead class="bg-base-300 text-center font-bold">
                <tr>
                    <th class="text-center" style="width: 5%">Alternatif</th>
                    <th class="text-center">Nama</th>
                    <th
                        v-for="criterion in criteriaData"
                        :key="criterion.id"
                        class="text-center"
                    >
                        {{ criterion.name }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in alternativeData"
                    :key="item.id"
                    class="hover bg-base-200"
                >
                    <td class="text-center">A{{ index + 1 }}</td>
                    <td class="text-center">{{ item.name }}</td>
                    <!-- <td
                        v-for="criterion in criteriaData"
                        :key="criterion.id"
                        class="cursor-pointer text-center"
                        @click="openModal(item, criterion)"
                    >
                        <div
                            :class="{
                                'text-red-500': !getValue(
                                    item.id,
                                    criterion.id,
                                ),
                            }"
                        >
                            {{
                                getSubcriteria(criterion.id).find(
                                    (sub) =>
                                        sub.value ===
                                        getValue(item.id, criterion.id),
                                )?.name || 'pilih'
                            }}
                        </div>
                    </td> -->
                    <td
                        v-for="criterion in criteriaData"
                        :key="criterion.id"
                        class="cursor-pointer text-center"
                        @click="openModal(item, criterion)"
                    >
                        <div
                            :class="{
                                'text-red-500': !getValue(
                                    item.id,
                                    criterion.id,
                                ),
                            }"
                        >
                            <template v-if="criterion.type === 'manual'">
                                {{ getValue(item.id, criterion.id) || 'pilih' }}
                            </template>
                            <template v-else>
                                {{
                                    getSubcriteria(criterion.id).find(
                                        (sub) =>
                                            sub.value ===
                                            getValue(item.id, criterion.id),
                                    )?.name || 'pilih'
                                }}
                            </template>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <table class="table-pin-cols table w-full">
            <thead class="bg-base-300 text-center font-bold">
                <tr>
                    <th class="text-center" style="width: 5%">Alternatif</th>
                    <th
                        v-for="(criterion, index) in criteriaData"
                        :key="criterion.id"
                        class="text-center"
                    >
                        C{{ index + 1 }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in alternativeData"
                    :key="item.id"
                    class="hover bg-base-200"
                >
                    <td class="text-center">A{{ index + 1 }}</td>
                    <td
                        v-for="criterion in criteriaData"
                        :key="criterion.id"
                        class="cursor-pointer text-center"
                        @click="openModal(item, criterion)"
                    >
                        <div
                            :class="{
                                'text-red-500': !getValue(
                                    item.id,
                                    criterion.id,
                                ),
                            }"
                        >
                            {{
                                getSubcriteria(criterion.id).find(
                                    (sub) =>
                                        sub.value ===
                                        getValue(item.id, criterion.id),
                                )?.value || '-'
                            }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> -->

        <!-- Modal -->
        <dialog id="criterion_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">
                    Set {{ selectedCriterion?.name }} for
                    {{ selectedAlternative?.name }}
                </h3>
                <div class="py-4">
                    <template v-if="selectedCriterion?.type === 'manual'">
                        <input
                            type="number"
                            :key="selectedCriterion?.id"
                            :id="selectedCriterion?.id"
                            v-model="selectedValue"
                            class="input input-bordered w-full"
                            placeholder="Enter value"
                        />
                    </template>
                    <template v-else>
                        <select
                            v-model="selectedValue"
                            class="select select-bordered w-full"
                        >
                            <option value="" disabled>Pilih nilai</option>
                            <option
                                v-for="sub in getSubcriteria(
                                    selectedCriterion?.id,
                                )"
                                :key="sub.id"
                                :value="sub.value"
                            >
                                {{ sub.value }}
                            </option>
                        </select>
                    </template>
                </div>
                <div class="modal-action">
                    <button class="btn" @click="closeModal">Cancel</button>
                    <button class="btn btn-primary" @click="saveValue">
                        Save
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </AuthenticatedLayout>
</template>
