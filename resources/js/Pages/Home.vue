<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Homepage" />
        <div class="hero bg-base-300 flex h-screen justify-center">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-3xl font-bold">
                        Sistem pendukung keputusan pemilihan smartphone terbaik
                        berbasis web menggunakan metode simple adsitive
                        weighting (saw)
                    </h1>
                    <p class="py-6">
                        Didalam sistem ini digunakan algoritma SAW atau yang
                        bisa disingkat dengan <i>Simple Additive Weighting</i>
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
        </div>
    </AuthenticatedLayout>
</template>
