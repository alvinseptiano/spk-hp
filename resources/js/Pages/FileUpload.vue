<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Heading from '@/Components/Heading.vue';
import { Head } from '@inertiajs/vue3';
import { TrashIcon } from '@heroicons/vue/24/solid';
import Checkbox from '@/Components/Checkbox.vue';

const selectedFiles = ref([]);
const loading = ref(false);
const success = ref(false);
const error = ref(null);
const uploading = ref(false);
const fileInput = ref(null);
const progress = ref(0);
const startTime = ref(null);
const processingTime = ref(0);
const uploadSpeed = ref(0);
const estimatedTimeRemaining = ref(0);
const emit = defineEmits(['upload-success']);

onMounted(() => {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (token) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }
});

const formatTime = (seconds) => {
    if (seconds < 60) {
        return `${seconds.toFixed(1)} seconds`;
    }
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${minutes}m ${remainingSeconds.toFixed(0)}s`;
};

const calculateSpeed = (loaded, elapsed) => {
    const speed = loaded / (elapsed / 1000); // bytes per second
    if (speed > 1000000) {
        return `${(speed / 1000000).toFixed(2)} MB/s`;
    }
    if (speed > 1000) {
        return `${(speed / 1000).toFixed(2)} KB/s`;
    }
    return `${speed.toFixed(2)} B/s`;
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const handleFileSelect = (event) => {
    const files = event.target.files;
    if (!files) return;

    // Create a fresh array from the FileList
    selectedFiles.value = Array.from(files).map((file) => ({
        name: file.name,
        size: file.size,
        file: file, // Keep the original file object for upload
    }));
    console.log(selectedFiles.value);
    error.value = null;
    success.value = false;
    progress.value = 0;
    processingTime.value = null;
    uploadSpeed.value = 0;
    estimatedTimeRemaining.value = null;
};

const removeFile = (index) => {
    selectedFiles.value = selectedFiles.value.filter((_, i) => i !== index);
    if (selectedFiles.value.length === 0) {
        fileInput.value.value = '';
        processingTime.value = null;
        uploadSpeed.value = 0;
        estimatedTimeRemaining.value = null;
    }
};

const uploadFile = async () => {
    if (!selectedFiles.value.length) return;

    const formData = new FormData();
    selectedFiles.value.forEach((fileObj, index) => {
        formData.append(`files[${index}]`, fileObj.file); // Use the stored file object
    });
    formData.append('passphrase', document.getElementById('passphrase').value);
    formData.append('nonce', document.getElementById('nonce').value);

    loading.value = true;
    uploading.value = true;
    error.value = null;
    startTime.value = Date.now();
    processingTime.value = null;

    try {
        const response = await axios.post('/upload', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onUploadProgress: (progressEvent) => {
                const currentTime = Date.now();
                const elapsed = (currentTime - startTime.value) / 1000; // seconds
                progress.value = Math.round(
                    (progressEvent.loaded * 100) / progressEvent.total,
                );

                // Calculate upload speed
                uploadSpeed.value = calculateSpeed(
                    progressEvent.loaded,
                    currentTime - startTime.value,
                );

                // Calculate ETA
                const remainingBytes =
                    progressEvent.total - progressEvent.loaded;
                const bytesPerSecond = progressEvent.loaded / elapsed;
                estimatedTimeRemaining.value = remainingBytes / bytesPerSecond;
            },
        });

        success.value = true;
        emit('upload-success', response.data.path);
        fileInput.value.value = '';

        // Calculate total processing time
        processingTime.value = (Date.now() - startTime.value) / 1000;

        selectedFiles.value = [];
    } finally {
        loading.value = false;
        uploading.value = false;
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Upload File" />
        <div class="flex h-full flex-col">
            <div class="mt-6 flex-none">
                <Heading>File Upload</Heading>
                <div class="flex h-full flex-row gap-8">
                    <!-- Form Section -->
                    <div class="flex w-1/2 flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <label for="passphrase">Passphrase</label>
                            <input
                                class="input input-bordered"
                                id="passphrase"
                                type="text"
                                :disabled="!selectedFiles.length"
                                placeholder="(*)@*@#14&2kb"
                            />
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="nonce">Nonce (Optional)</label>
                            <input
                                class="input input-bordered"
                                id="nonce"
                                type="text"
                                :disabled="!selectedFiles.length"
                            />
                        </div>

                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text"
                                    >Sama dengan password akun</span
                                >
                                <Checkbox />
                            </label>
                        </div>

                        <div class="mt-4 flex gap-4">
                            <input
                                ref="fileInput"
                                type="file"
                                multiple
                                class="file-input file-input-bordered w-full"
                                @change="handleFileSelect"
                            />
                            <button
                                @click="uploadFile"
                                class="btn btn-primary w-fit"
                                :disabled="
                                    selectedFiles.length === 0 || uploading
                                "
                            >
                                {{
                                    uploading
                                        ? 'Uploading...'
                                        : 'Upload & Encrypt'
                                }}
                            </button>
                        </div>

                        <!-- Upload Information -->
                        <div class="my-10 flex-1">
                            <div
                                class="min-h-48 w-full rounded-lg bg-base-300 p-4"
                            >
                                <div class="flex flex-col">
                                    <div class="mb-4 flex items-center gap-2">
                                        <div class="badge font-bold">
                                            Output:
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-1 flex-row justify-between space-y-4"
                                    >
                                        <div class="flex flex-col gap-4">
                                            <div>
                                                <span>
                                                    {{
                                                        progress === 0
                                                            ? 'Starting upload...'
                                                            : progress < 100
                                                              ? 'Upload in progress'
                                                              : 'Finalizing upload...'
                                                    }}
                                                </span>
                                                <span
                                                    v-if="loading"
                                                    class="loading loading-spinner ml-4 text-primary"
                                                ></span>
                                            </div>
                                            <div>
                                                <span
                                                    >Speed:
                                                    {{ uploadSpeed }}</span
                                                >
                                            </div>
                                            <div class="font-mono">
                                                ETA:
                                                {{
                                                    formatTime(
                                                        estimatedTimeRemaining ??
                                                            0,
                                                    )
                                                }}
                                            </div>
                                        </div>

                                        <div
                                            class="radial-progress mr-10 text-primary"
                                            :style="{
                                                '--value': progress,
                                                '--size': '6rem',
                                                '--thickness': '1rem',
                                            }"
                                            role="progressbar"
                                        >
                                            {{ progress }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider divider-horizontal -mx-4"></div>
                    <!-- Selected Files Section -->
                    <div class="flex w-1/2 flex-col">
                        <div class="h-full w-full rounded-lg">
                            <div v-if="selectedFiles.length > 0" class="w-full">
                                <h3 class="mb-4 text-lg font-semibold">
                                    File terpilih
                                </h3>
                                <div class="h-[500px] overflow-y-auto">
                                    <ul
                                        class="menu menu-md w-full justify-start rounded-box"
                                    >
                                        <li
                                            v-for="(
                                                file, index
                                            ) in selectedFiles"
                                            :key="index"
                                            class="flex flex-row items-center justify-start rounded-lg p-3"
                                        >
                                            <!-- Added justify-start to align content to the left -->
                                            <div
                                                class="flex min-w-0 flex-1 flex-col items-start justify-start gap-1"
                                            >
                                                <span
                                                    class="max-w-[200px] overflow-hidden truncate text-ellipsis text-left text-sm hover:overflow-visible hover:whitespace-normal"
                                                    :title="file.name"
                                                >
                                                    {{ file.name }}
                                                </span>
                                                <span
                                                    class="badge badge-outline text-left text-xs"
                                                >
                                                    {{
                                                        formatFileSize(
                                                            file.size,
                                                        )
                                                    }}
                                                </span>
                                            </div>
                                            <button
                                                @click="removeFile(index)"
                                                class="btn btn-ghost"
                                                type="button"
                                            >
                                                <TrashIcon
                                                    class="size-5 text-error"
                                                />
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div
                                v-else
                                class="mt-4 w-full text-center text-gray-500"
                            >
                                Tidak ada file terpilih
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
