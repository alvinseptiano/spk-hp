<script setup>
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref, watch, nextTick, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AccentButton from '@/Components/AccentButton.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import axios from 'axios';

const page = usePage();
const modalType = ref('');
const isModalOpen = ref(false);
const formData = ref(null);
const tableData = ref({ criteria: [] });
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

const handleSubmit = async (data) => {
    await nextTick();
    try {
        let response;
        data.type = modalType.value;

        if (modalType.value == 'subcriteria') {
            response = router.post(`/addsubcriteria/${itemId.value}`, data);
        } else {
            if (actionType.value == 'edit') {
                response = router.put('/update', data);
            } else {
                response = router.post('/add', data);
            }
        }

        isModalOpen.value = false;
        formData.value = null;

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
        // Ensure alternative is always an array
        tableData.value = {
            criteria: Array.isArray(response.data.data?.criteria)
                ? response.data.data.criteria
                : [],
        };
    } catch (error) {
        console.error('Error fetching items:', error);
        tableData.value = { criteria: [] };
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
    () => page.props?.flash?.refresh,
    async (newValue) => {
        if (newValue) {
            await fetchItems();
            router.visit(window.location.pathname, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
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
            :title="`${actionType === 'edit' ? 'edit' : 'add'} ${modalType}`"
            :type="modalType"
            :edit-data="formData"
            @submit="handleSubmit"
        />

        <div role="tablist" class="tabs-box tabs">
            <div class="max-h-[80vh] w-full overflow-x-auto p-4">
                <div class="flex flex-col gap-6">
                    <AccentButton @click="openModal('criteria')">
                        Add Kriteria
                    </AccentButton>
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
                                v-for="(item, index) in tableData.criteria"
                                :key="item.id"
                            >
                                <td class="text-center">C{{ index + 1 }}</td>
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
                                            openModal('criteria', 'edit', item)
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
                                        <TrashIcon class="text-error size-5" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
