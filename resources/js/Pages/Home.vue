<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Homepage" />

        <!-- Hero with background -->
        <div
            class="relative flex h-screen items-center justify-center bg-cover bg-center"
            style="
                background-image: url('https://images.pexels.com/photos/19037726/pexels-photo-19037726.jpeg');
            "
        >
            <!-- Overlay (optional, can adjust opacity) -->
            <div class="absolute inset-0 bg-black/80"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-md text-center text-white">
                <h1
                    class="text-3xl font-bold"
                    style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7)"
                >
                    Sistem pendukung keputusan pemilihan smartphone terbaik
                    berbasis web menggunakan metode simple additive weighting
                    (SAW)
                </h1>
                <p class="py-6">
                    Didalam sistem ini digunakan algoritma SAW atau yang bisa
                    disingkat dengan
                    <i>Simple Additive Weighting</i>
                </p>
                <div class="flex justify-center gap-2">
                    <InertiaLink href="/rekomendasi">
                        <button class="btn btn-primary">
                            Rekomendasikan Smartphone
                        </button>
                    </InertiaLink>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
