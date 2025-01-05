<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Heading from '@/Components/Heading.vue';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Input Data" />
        <div class="mt-6 flex flex-col gap-4">
            <!-- <div class="mockup-phone">
                <div class="camera"></div>
                <div class="display">
                    <div
                        class="artboard artboard-demo phone-1 text-center text-3xl font-bold"
                    >
                        Rekomendasi smartphone anda adalah Xiaomi
                    </div>
                </div>
            </div> -->
            <Heading>File Upload</Heading>
            <div class="flex h-full flex-row gap-8">
                <!-- Form Section -->
                <div class="flex w-1/2 flex-col gap-4">
                    <h3 class="mb-4 text-lg font-semibold">Alternatif</h3>
                    <div class="flex flex-col gap-2">
                        <label for="passphrase">Passphrase</label>
                        <input
                            class="input input-bordered"
                            id="passphrase"
                            type="text"
                            placeholder="(*)@*@#14&2kb"
                        />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="nonce">Nonce (Optional)</label>
                        <input
                            class="input input-bordered"
                            id="nonce"
                            type="text"
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
                        />
                        <button class="btn btn-primary w-fit">
                            {{
                                uploading ? 'Uploading...' : 'Upload & Encrypt'
                            }}
                        </button>
                    </div>
                </div>

                <div class="divider divider-horizontal -mx-4"></div>

                <!-- Selected Files Section -->
                <div class="flex w-1/2 flex-col">
                    <div class="h-full w-full rounded-lg">
                        <div class="w-full">
                            <h3 class="mb-4 text-lg font-semibold">Kriteria</h3>
                            <div class="h-[500px] overflow-y-auto">
                                <ul
                                    class="menu menu-md w-full justify-start rounded-box"
                                ></ul>
                            </div>
                        </div>
                        <div class="mt-4 w-full text-center text-gray-500">
                            Tidak ada file terpilih
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
