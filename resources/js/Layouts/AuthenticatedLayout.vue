<script setup>
import TopBar from '@/Components/TopBar.vue';
import { ref, watch } from 'vue';
import SideBarIcon from '@/Components/SideBarIcon.vue';
import MenuItem from '@/Components/MenuItem.vue';
import { router, usePage } from '@inertiajs/vue3';

import {
    HomeIcon,
    UserIcon,
    TableCellsIcon,
    DocumentChartBarIcon,
    ChartBarIcon,
} from '@heroicons/vue/24/solid';

const page = usePage();
const isOpen = ref(localStorage.getItem('sidebarOpen') === 'true' || false);

const logout = () => {
    console.log('logout');
    router.post('/logout', {
        _token: page.props.csrf_token,
    });
};

watch(isOpen, (newValue) => {
    localStorage.setItem('sidebarOpen', newValue);
});
</script>

<template>
    <div class="bg-base-100 fixed size-full min-h-svh">
        <div class="bg-base-300 fixed top-0 right-0 left-0 z-50 m-4 rounded-lg">
            <TopBar />
        </div>

        <div class="flex flex-row justify-between pt-20">
            <!-- Sidebar -->
            <div
                :class="[
                    'bg-base-300 fixed z-20 m-4 h-[calc(100vh-7rem)] flex-none shrink-0 rounded-lg transition-all duration-300 ease-in-out',
                    isOpen ? 'w-48' : 'w-18',
                ]"
            >
                <!-- Top section -->
                <div class="mx-2 mt-4 flex shrink-0 items-center">
                    <button
                        @click="isOpen = !isOpen"
                        class="btn btn-ghost flex items-center"
                    >
                        <SideBarIcon :isOpen="isOpen" />
                    </button>
                    <h2
                        :class="[
                            'text-xl font-bold transition-opacity',
                            isOpen ? 'opacity-100' : 'hidden opacity-0',
                        ]"
                    ></h2>
                </div>

                <!-- Center section with navigation -->
                <div class="flex flex-1 items-start">
                    <nav class="w-full">
                        <ul class="menu w-full font-bold">
                            <div class="divider my-1 shrink-0"></div>
                            <MenuItem
                                :icon="HomeIcon"
                                :name="`Home`"
                                :link="`home`"
                                :isOpen="isOpen"
                            />
                            <MenuItem
                                :icon="DocumentChartBarIcon"
                                :name="`Alternatif`"
                                :link="`alternatif`"
                                :isOpen="isOpen"
                            />
                            <MenuItem
                                :icon="DocumentChartBarIcon"
                                :name="`Kriteria`"
                                :link="`kriteria`"
                                :isOpen="isOpen"
                            />
                            <MenuItem
                                :icon="DocumentChartBarIcon"
                                :name="`Sub Kriteria`"
                                :link="`subkriteria`"
                                :isOpen="isOpen"
                            />
                            <MenuItem
                                :icon="TableCellsIcon"
                                :name="`List HP`"
                                :link="`matrix`"
                                :isOpen="isOpen"
                            />
                            <MenuItem
                                :icon="ChartBarIcon"
                                :name="`Hasil Peniliaian`"
                                :link="`preferensi`"
                                :isOpen="isOpen"
                            />
                            <div class="divider my-1 shrink-0"></div>
                            <MenuItem
                                :icon="UserIcon"
                                :name="`Akun`"
                                :link="`profile`"
                                :isOpen="isOpen"
                            />
                            <button @click="logout" class="btn btn-error my-5">
                                Logout
                            </button>
                        </ul>
                    </nav>
                </div>
            </div>

            <main
                :class="[
                    'max-h-[86vh] w-full flex-1 overflow-auto p-4',
                    { 'ml-24': !isOpen, 'ml-52': isOpen },
                ]"
            >
                <slot />
            </main>
        </div>
    </div>
</template>
