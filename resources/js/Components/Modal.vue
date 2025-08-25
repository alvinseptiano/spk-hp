<script setup>
import { reactive, watch, ref, onBeforeUnmount } from 'vue';
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

const modalBox = ref(null);
let isDragging = false;
let offsetX = 0;
let offsetY = 0;

const handleMouseDown = (e) => {
    if (!modalBox.value) return;
    isDragging = true;

    // get initial offset
    const rect = modalBox.value.getBoundingClientRect();
    offsetX = e.clientX - rect.left;
    offsetY = e.clientY - rect.top;

    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', handleMouseUp);
};

const handleMouseMove = (e) => {
    if (!isDragging || !modalBox.value) return;
    modalBox.value.style.left = e.clientX - offsetX + 'px';
    modalBox.value.style.top = e.clientY - offsetY + 'px';
};

const handleMouseUp = () => {
    isDragging = false;
    document.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseup', handleMouseUp);
};

// Cleanup on unmount
onBeforeUnmount(() => {
    document.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseup', handleMouseUp);
});

const handleSubmit = () => {
    emit('submit', {
        ...form,
        type: form.type,
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
        <div
            ref="modalBox"
            class="modal-box relative max-w-64"
            style="position: absolute"
        >
            <!-- Drag handle -->
            <div
                class="flex cursor-move items-center justify-between select-none"
                @mousedown="handleMouseDown"
            >
                <h3 class="text-lg font-bold">{{ title }}</h3>
                <button
                    class="btn btn-circle btn-ghost btn-sm"
                    type="button"
                    @click="$emit('update:modelValue', false)"
                >
                    ✕
                </button>
            </div>

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
