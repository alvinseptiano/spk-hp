<script setup>
import { Head, router, usePage, WhenVisible } from '@inertiajs/vue3';
import { ref, watch, nextTick, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import {
    PencilSquareIcon,
    TrashIcon,
    PlusCircleIcon,
    PlusIcon,
} from '@heroicons/vue/24/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AccentButton from '@/Components/AccentButton.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import axios from 'axios';

const page = usePage();
const modalType = ref('');
const isModalOpen = ref(false);
const formData = ref(null);
const tableData = ref([]);
const actionType = ref('');
const showToast = ref(false);
const toastMessage = ref('');
const itemId = ref(0);

const openModal = (type, action, data = null, id = null) => {
    modalType.value = type;
    actionType.value = action;
    formData.value = data;
    isModalOpen.value = true;
    itemId.value = id;
};

const handleDelete = (type, id, name) => {
    if (!confirm(`Yakin ingin menghapus ${name}?`)) return;

    router.delete(`/${type}/${id}`, {
        preserveScroll: true,
        onFinish: () => {
            loading.value = false;
        },
    });
};

const handleSubmit = async (formData) => {
    await nextTick(); // Wait for all DOM and reactive updates to complete
    try {
        let response;
        formData.type = modalType.value;

        if (modalType.value == 'subcriteria') {
            console.log('sub criteria!!');
            response = router.post(`/addsubcriteria/${itemId.value}`, formData);
        } else {
            if (actionType.value == 'edit') {
                response = router.put('/update', formData);
            } else {
                response = router.post('/add', formData);
            }
        }

        isModalOpen.value = false;
        formData.value = null;

        // fetchItems;

        return response;
    } catch (error) {
        console.error('An error occurred while submitting the form:', error);
        throw error;
    }
};

// Your existing fetchItems function
const fetchItems = async () => {
    try {
        const response = await axios.get(`/getdata`);
        tableData.value = response.data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
    }
};

watch(
    () => isModalOpen.value,
    (isOpen) => {
        if (!isOpen) {
            formData.value = null;
        }
    },
);

watch(
    () => page.props.flash.refresh,
    async (newValue) => {
        if (newValue) {
            await fetchItems();
            // showToast.value = true;
            router.visit(window.location.pathname, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                // onSuccess: () => {
                //     if (page.props.flash.message) {
                //         toastMessage.value = page.props.flash.message;
                //         showToast.value = true;
                //         setTimeout(() => {
                //             showToast.value = false;
                //         }, 3000);
                //     }
                // },
            });
        }
    },
    { immediate: true },
);

onMounted(() => {
    fetchItems();
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Input Data" />
        <FlashMessage :show="showToast" :message="toastMessage" />
        <Modal
            v-model="isModalOpen"
            :title="`${formData ? 'edit' : 'add'} ${modalType}`"
            :type="modalType"
            :edit-data="formData"
            @submit="handleSubmit"
        />

        <div class="">
            <div role="tablist" class="tabs-box tabs">
                <!-- Alternatif Section -->
                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Alternatif"
                    checked="checked"
                />
                <div
                    role="tabpanel"
                    class="tab-content max-h-[80vh] overflow-y-auto p-4"
                >
                    <div class="flex flex-col gap-6">
                        <AccentButton @click="openModal('alternative')">
                            <PlusCircleIcon class="size-5" />
                            Alternatif
                        </AccentButton>
                        <div class="">
                            <table class="table-pin-rows table-pin-cols table">
                                <thead
                                    class="bg-base-300 text-center font-bold"
                                >
                                    <tr>
                                        <th
                                            class="text-center"
                                            style="width: 5%"
                                        >
                                            Alternatif
                                        </th>
                                        <th class="text-center">Nama</th>

                                        <th
                                            class="text-center"
                                            style="width: 5%"
                                        >
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr
                                        v-for="(item, index) in tableData[
                                            'alternative'
                                        ]"
                                        :key="item.id"
                                    >
                                        <td class="text-center">
                                            A{{ index + 1 }}
                                        </td>
                                        <td class="text-center">
                                            {{ item.name }}
                                        </td>
                                        <td class="flow-row flex">
                                            <button
                                                class="btn btn-ghost"
                                                @click="
                                                    openModal(
                                                        'alternative',
                                                        'edit',
                                                        item,
                                                    )
                                                "
                                            >
                                                <PencilSquareIcon
                                                    class="h-5 w-5"
                                                />
                                            </button>
                                            <button
                                                class="btn btn-ghost"
                                                @click="
                                                    handleDelete(
                                                        'alternative',
                                                        item.id,
                                                        item.name,
                                                    )
                                                "
                                            >
                                                <TrashIcon
                                                    class="text-error size-5"
                                                />
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Kriteria Section -->
                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Kriteria"
                />

                <div
                    role="tabpanel"
                    class="tab-content max-h-[80vh] overflow-y-auto p-4"
                >
                    <div class="flex flex-col gap-4">
                        <AccentButton @click="openModal('criteria')">
                            <PlusCircleIcon class="size-5" />
                            Kriteria
                        </AccentButton>
                        <WhenVisible />
                        <table class="table-pin-rows table-pin-cols table">
                            <thead class="bg-base-300 text-center">
                                <tr>
                                    <th class="text-center" style="width: 5%">
                                        Kriteria
                                    </th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Bobot</th>
                                    <th class="text-center">Atribut</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center" style="width: 5%">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr
                                    v-for="(item, index) in tableData[
                                        'criteria'
                                    ]"
                                    :key="item.id"
                                >
                                    <td class="text-center">
                                        C{{ index + 1 }}
                                    </td>
                                    <td class="text-center">{{ item.name }}</td>
                                    <td class="text-center">
                                        {{ item.weight }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.attribute }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.type }}
                                    </td>
                                    <td class="flex justify-center gap-2">
                                        <button
                                            class="btn btn-ghost btn-sm"
                                            @click="
                                                openModal(
                                                    'criteria',
                                                    'edit',
                                                    item,
                                                )
                                            "
                                        >
                                            <PencilSquareIcon class="size-5" />
                                        </button>
                                        <button
                                            class="btn btn-ghost"
                                            @click="
                                                handleDelete(
                                                    'criteria',
                                                    item.id,
                                                    item.name,
                                                )
                                            "
                                        >
                                            <TrashIcon
                                                class="text-error size-5"
                                            />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Sub Kriteria -->
                <input
                    type="radio"
                    name="my_tabs_2"
                    role="tab"
                    class="tab"
                    aria-label="Sub Kriteria"
                />
                <div
                    role="tabpanel"
                    class="tab-content max-h-[80vh] overflow-y-auto p-4"
                >
                    <div class="flex flex-col">
                        <table
                            class="table-pin-rows table-pin-cols table h-full"
                        >
                            <thead class="bg-base-300 text-center">
                                <tr>
                                    <th class="text-center" style="width: 5%">
                                        Kriteria
                                    </th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center" style="width: 10%">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr
                                    v-for="(item, index) in tableData[
                                        'criteria'
                                    ]"
                                    :key="item.name"
                                >
                                    <td class="text-center">
                                        C{{ index + 1 }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.name }}
                                    </td>
                                    <td class="flex justify-center gap-2">
                                        <button
                                            class="btn btn-ghost btn-sm"
                                            @click="
                                                openModal(
                                                    'subcriteria',
                                                    'edit',
                                                    item,
                                                    item.id,
                                                )
                                            "
                                        >
                                            <PlusIcon
                                                v-if="item.type === 'option'"
                                                class="size-5"
                                            />
                                        </button>
                                        <button
                                            class="btn btn-ghost btn-sm"
                                            @click="
                                                handleDelete(
                                                    'criteria',
                                                    item.id,
                                                    item.name,
                                                )
                                            "
                                        >
                                            <TrashIcon
                                                class="text-error size-5"
                                            />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table-pin-rows table-pin-cols table">
                            <thead class="bg-base-300 text-center">
                                <tr>
                                    <!-- <th class="text-center" style="width: 5%">
                                        Kriteria
                                    </th> -->
                                    <th class="text-center">Sub Kriteria</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center" style="width: 10%">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr
                                    v-for="item in tableData['subcriteria']"
                                    :key="item.name"
                                >
                                    <!-- <td class="text-center">C{{ item.id }}</td> -->
                                    <td class="text-center">
                                        {{ item.name }}
                                        <!-- <div class="badge">C{{ item.id }}</div> -->
                                    </td>
                                    <td class="text-center">
                                        {{ item.value }}
                                    </td>
                                    <td class="flex justify-center gap-2">
                                        <button
                                            class="btn btn-ghost btn-sm"
                                            @click="
                                                handleDelete(
                                                    'subcriteria',
                                                    item.id,
                                                    item.name,
                                                )
                                            "
                                        >
                                            <TrashIcon
                                                class="text-error size-5"
                                            />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Alternatif Section -->
        </div>
    </AuthenticatedLayout>
</template>
