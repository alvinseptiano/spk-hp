<script setup>
import { Link as InertiaLink } from '@inertiajs/vue3';
import TopBar from '@/Components/TopBar.vue';
</script>

<template>
    <Head title="Dashboard" />
    <TopBar />
    <div class="hero bg-base-300 flex h-screen justify-center">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">
                    Sistem Pendukung Keputusan SAW Smartphone
                </h1>
                <p class="py-6">
                    Didalam sistem ini digunakan algoritma SAW atau yang bisa
                    disingkat dengan <i>Simple Addition Weighting</i>
                </p>
                <div class="flex justify-center gap-2">
                    <InertiaLink href="/inputdata"
                        ><button class="btn btn-info">
                            Admin panel
                        </button></InertiaLink
                    >
                    <InertiaLink href="/rekomendasi">
                        <button class="btn btn-primary">
                            Rekomendasikan Smartphone
                        </button>
                    </InertiaLink>
                </div>
            </div>
        </div>
    </div>
    <div>
        <InertiaLink href="/inputdata"
            ><span class="text-3xl">admin</span></InertiaLink
        >
    </div>
</template>
