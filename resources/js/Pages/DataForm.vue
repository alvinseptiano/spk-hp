<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    PencilSquareIcon,
    PlusCircleIcon,
    TrashIcon,
} from '@heroicons/vue/24/solid';
import AccentButton from '@/Components/AccentButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';

// import { onMounted } from 'vue';
const formData = ref({
    name: '',
    weight: null,
});
const loading = ref(false);

const submitForm = async () => {
    loading.value = true;
    try {
        const response = await axios.post('/add', formData.value);
        document.getElementById('criteria_modal').close();
        emit('criteria-added');
    } catch (error) {
        console.error('Error:', error);
    } finally {
        loading.value = false;
    }
};
const closeModal = () => {
    document.getElementById('alternative_modal').close();
    document.getElementById('criteria_modal').close();
};
const emit = defineEmits(['criteria-added']);
// onMounted(async () => {
//     try {
//         const response = await fetch('/getdata');
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         tableData.value = await response.json();
//         console.log('Response:', tableData.value); // Debug log
//     } catch (error) {
//         console.error('Error fetching data:', error);
//     }
// });
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Input Data" />
        <div role="tablist" class="tabs-boxed tabs">
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="tab"
                aria-label="Alternatif"
                checked="checked"
            />
            <div role="tabpanel" class="tab-content p-6">
                <div class="flex flex-col gap-4">
                    <AccentButton onclick="alternative_modal.showModal()">
                        <PlusCircleIcon class="size-5" />
                        Alternatif
                    </AccentButton>

                    <table class="table table-zebra shadow-sm">
                        <thead class="bg-base-300 text-center font-bold">
                            <tr>
                                <th class="text-center" style="width: 5%">
                                    Alternatif
                                </th>
                                <th class="text-center">Nama</th>

                                <th class="text-center" style="width: 5%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="text-center">A1</td>
                                <td class="text-center">Redmi 9A</td>
                                <td class="flex justify-center gap-2">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="tab"
                aria-label="Kriteria"
            />
            <div role="tabpanel" class="tab-content p-10">
                <!-- Kriteria Section -->
                <div class="flex flex-col gap-4">
                    <AccentButton onclick="criteria_modal.showModal()">
                        <PlusCircleIcon class="size-5" />
                        Kriteria
                    </AccentButton>
                    <table class="table table-zebra shadow-sm">
                        <thead class="bg-base-300 text-center">
                            <tr>
                                <th class="text-center" style="width: 5%">
                                    Kriteria
                                </th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Bobot</th>
                                <th class="text-center">Atribut</th>
                                <th class="text-center" style="width: 5%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="text-center">C1</td>
                                <td class="text-center">Resolusi Layar</td>
                                <td class="text-center">2.5</td>
                                <td class="text-center">Benefit</td>
                                <td class="flex justify-center gap-2">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <input
                type="radio"
                name="my_tabs_2"
                role="tab"
                class="tab"
                aria-label="Sub Kriteria"
            />
            <div role="tabpanel" class="tab-content p-10">
                <div class="flex flex-col gap-4">
                    <table class="table table-zebra shadow-sm">
                        <thead class="bg-base-300 text-center">
                            <tr>
                                <th class="text-center" style="width: 5%">
                                    Kriteria
                                </th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Sub Kriteria</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center" style="width: 5%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="text-center">C1</td>
                                <td class="text-center">Resolusi Layar</td>
                                <td class="text-center">FHD</td>
                                <td class="text-center">50</td>
                                <td class="flex justify-center gap-2">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Alternatif Section -->

        <!-- Modal alternatif-->
        <dialog id="alternative_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Tambah Alternatif</h3>

                <div class="modal-action">
                    <form method="dialog">
                        <button
                            class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2"
                        >
                            ✕
                        </button>
                        <div class="w-full">
                            <div class="flex flex-col gap-2">
                                <label for="passphrase">Bobot</label>
                                <input
                                    class="input input-bordered"
                                    id="passphrase"
                                    type="text"
                                    placeholder=""
                                />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="passphrase">Bobot</label>
                                <input
                                    class="input input-bordered"
                                    id="passphrase"
                                    type="text"
                                    placeholder=""
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- Modal kriteria -->
        <dialog id="criteria_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Tambah Kriteria</h3>
                <div class="modal-action">
                    <form @submit.prevent="submitForm">
                        <button
                            class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2"
                            type="button"
                            @click="closeModal"
                        >
                            ✕
                        </button>
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="alternative_name">Nama</label>
                                <input
                                    v-model="formData.name"
                                    class="input input-bordered"
                                    id="alternative_name"
                                    type="text"
                                />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="alternative_weight">Bobot</label>
                                <input
                                    v-model="formData.weight"
                                    class="input input-bordered"
                                    id="alternative_weight"
                                    type="number"
                                />
                            </div>
                            <PrimaryButton :loading="loading"
                                >Proses</PrimaryButton
                            >
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    </AuthenticatedLayout>
</template>
