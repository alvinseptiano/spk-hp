<!-- Modal.vue -->
<script setup>
import { reactive, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    modelValue: Boolean,
    title: String,
    type: String, // 'criteria' or 'alternative'
    editData: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(['update:modelValue', 'submit']);

const form = reactive({
    type: props.type,
    data: {
        name: '',
        weight: '',
        attribute: '',
        value: '',
    },
});

const handleSubmit = () => {
    emit('submit', {
        ...form,
        type: form.type,
        // id: props.editData?.id, // Include ID if editing
    });
    emit('update:modelValue', false);
};

// Watch for editData changes to fill the form
watch(
    () => props.editData,
    (newVal) => {
        if (newVal) {
            form.data = { ...newVal };
        }
    },
    { immediate: true },
);

// Reset form when modal closes
watch(
    () => props.modelValue,
    (newVal) => {
        if (!newVal && !props.editData) {
            form.data.name = '';
            form.data.weight = '';
            form.data.attribute = '';
        }
    },
);
</script>

<template>
    <dialog
        class="modal"
        :open="modelValue"
        @close="$emit('update:modelValue', false)"
    >
        <div class="modal-box relative max-w-64">
            <h3 v-mode="form.type" class="text-lg font-bold">{{ title }}</h3>
            <button
                class="btn btn-circle btn-ghost btn-sm absolute top-2 right-2"
                type="button"
                @click="$emit('update:modelValue', false)"
            >
                ✕
            </button>

            <form @submit.prevent="handleSubmit" class="mt-4 space-y-4">
                <!-- Name field - always shown -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input
                        v-model="form.data.name"
                        type="text"
                        class="input input-bordered w-full"
                        required
                    />
                </div>

                <!-- Criteria-specific fields -->
                <template v-if="type === 'criteria'">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Weight</span>
                        </label>
                        <input
                            v-model="form.data.weight"
                            type="number"
                            step="0.01"
                            class="input input-bordered w-full"
                            required
                        />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Attribute</span>
                        </label>
                        <select class="select" v-model="form.data.attribute">
                            <option disabled selected>Atribut</option>
                            <option value="cost">Cost</option>
                            <option value="benefit">Benefit</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tipe</span>
                        </label>
                        <select class="select" v-model="form.data.type">
                            <option disabled selected>Tipe</option>
                            <option value="option">Option</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>
                </template>

                <template v-else-if="type === 'subcriteria'">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nilai</span>
                        </label>
                        <input
                            v-model="form.data.value"
                            type="number"
                            step="0.01"
                            class="input input-bordered w-full"
                            required
                        />
                    </div>
                </template>

                <div class="modal-action">
                    <PrimaryButton type="submit"> Proses </PrimaryButton>
                </div>
            </form>
        </div>
    </dialog>
</template>
