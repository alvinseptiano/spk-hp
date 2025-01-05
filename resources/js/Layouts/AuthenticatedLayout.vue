<script setup>
import TopBar from '@/Components/TopBar.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import SideBarIcon from '@/Components/SideBarIcon.vue';
import {
    UserIcon,
    TableCellsIcon,
    FolderIcon,
    ArrowUpOnSquareStackIcon,
    HomeIcon,
} from '@heroicons/vue/24/solid';

const isOpen = ref(localStorage.getItem('sidebarOpen') === 'true' || false);

watch(isOpen, (newValue) => {
    localStorage.setItem('sidebarOpen', newValue);
});

const isActive = (path) => {
    return window.location.pathname === path;
};
</script>

<template>
    <div class="fixed size-full min-h-svh bg-base-100">
        <div class="fixed left-0 right-0 top-0 z-50 m-4 rounded-lg bg-base-300">
            <TopBar />
        </div>

        <div class="flex flex-row justify-between pt-20">
            <!-- Sidebar -->
            <div
                :class="[
                    'fixed z-20 m-4 h-[calc(100vh-7rem)] flex-none shrink-0 rounded-lg bg-base-300 transition-all duration-300 ease-in-out',
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
                    >
                        Dashboard
                    </h2>
                </div>

                <!-- Center section with navigation -->
                <div class="flex flex-1 items-start">
                    <nav class="w-full">
                        <ul class="menu w-full font-bold">
                            <div class="divider my-1 shrink-0"></div>
                            <li class="rounded">
                                <InertiaLink
                                    href="/dashboard"
                                    :class="[
                                        'relative flex items-center py-4',
                                        {
                                            'bg-primary/10':
                                                isActive('/dashboard'),
                                        },
                                        !isOpen && 'justify-center',
                                    ]"
                                >
                                    <div
                                        v-if="isActive('/dashboard')"
                                        class="absolute left-0 top-0 h-full w-1 bg-primary"
                                    ></div>
                                    <HomeIcon
                                        :class="[
                                            'size-5',
                                            {
                                                'text-primary':
                                                    isActive('/dashboard'),
                                            },
                                        ]"
                                    />
                                    <span :class="['ml-2', !isOpen && 'hidden']"
                                        >Home</span
                                    >
                                </InertiaLink>
                            </li>
                            <li class="rounded">
                                <InertiaLink
                                    href="/uploadfile"
                                    :class="[
                                        'relative flex items-center py-4',
                                        {
                                            'bg-primary/10':
                                                isActive('/uploadfile'),
                                        },
                                        !isOpen && 'justify-center',
                                    ]"
                                >
                                    <div
                                        v-if="isActive('/uploadfile')"
                                        class="absolute left-0 top-0 h-full w-1 bg-primary"
                                    ></div>
                                    <ArrowUpOnSquareStackIcon
                                        :class="[
                                            'size-5',
                                            {
                                                'text-primary':
                                                    isActive('/uploadfile'),
                                            },
                                        ]"
                                    />
                                    <span :class="['ml-2', !isOpen && 'hidden']"
                                        >Upload File</span
                                    >
                                </InertiaLink>
                            </li>
                            <li class="rounded">
                                <InertiaLink
                                    href="/myfiles"
                                    :class="[
                                        'relative flex items-center py-4',
                                        {
                                            'bg-primary/10':
                                                isActive('/myfiles'),
                                        },
                                        !isOpen && 'justify-center',
                                    ]"
                                >
                                    <div
                                        v-if="isActive('/myfiles')"
                                        class="absolute left-0 top-0 h-full w-1 bg-primary"
                                    ></div>
                                    <FolderIcon
                                        :class="[
                                            'size-5',
                                            {
                                                'text-primary':
                                                    isActive('/myfiles'),
                                            },
                                        ]"
                                    />
                                    <span :class="['ml-2', !isOpen && 'hidden']"
                                        >My Files</span
                                    >
                                </InertiaLink>
                            </li>
                            <li class="rounded">
                                <InertiaLink
                                    href="/hextable"
                                    :class="[
                                        'relative flex items-center py-4',
                                        {
                                            'bg-primary/10':
                                                isActive('/hextable'),
                                        },
                                        !isOpen && 'justify-center',
                                    ]"
                                >
                                    <div
                                        v-if="isActive('/hextable')"
                                        class="absolute left-0 top-0 h-full w-1 bg-primary"
                                    ></div>
                                    <TableCellsIcon
                                        :class="[
                                            'size-5',
                                            {
                                                'text-primary':
                                                    isActive('/hextable'),
                                            },
                                        ]"
                                    />
                                    <span :class="['ml-2', !isOpen && 'hidden']"
                                        >Hex Table</span
                                    >
                                </InertiaLink>
                            </li>
                            <div class="divider my-1 shrink-0"></div>
                            <li class="rounded">
                                <InertiaLink
                                    href="/profile"
                                    :class="[
                                        'relative flex items-center py-4',
                                        {
                                            'bg-primary/10':
                                                isActive('/profile'),
                                        },
                                        !isOpen && 'justify-center',
                                    ]"
                                >
                                    <div
                                        v-if="isActive('/profile')"
                                        class="absolute left-0 top-0 h-full w-1 bg-primary"
                                    ></div>
                                    <UserIcon
                                        :class="[
                                            'size-5',
                                            {
                                                'text-primary':
                                                    isActive('/profile'),
                                            },
                                        ]"
                                    />
                                    <span :class="['ml-2', !isOpen && 'hidden']"
                                        >Akun</span
                                    >
                                </InertiaLink>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <main
                :class="['flex-1 p-4', { 'ml-24': !isOpen, 'ml-52': isOpen }]"
            >
                <slot />
            </main>
        </div>
    </div>
</template>
