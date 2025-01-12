<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import {
    SunIcon,
    MoonIcon,
    ExclamationCircleIcon,
} from '@heroicons/vue/24/solid';
const page = usePage();

const logout = () => {
    router.post('/logout', {
        _token: page.props.csrf_token,
    });
};

const currentTheme = ref('nord');

const toggleTheme = () => {
    const newTheme = currentTheme.value === 'nord' ? 'dim' : 'nord';
    applyTheme(newTheme);
};

const initializeTheme = () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme && (savedTheme === 'nord' || savedTheme === 'dim')) {
        applyTheme(savedTheme);
    } else {
        applyTheme('nord');
    }
};

const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    currentTheme.value = theme;
    localStorage.setItem('theme', theme);
};

onMounted(() => {
    initializeTheme();
});
</script>

<template>
    <div class="navbar">
        <div class="navbar-start">
            <div class="dropdown">
                <div
                    tabindex="0"
                    role="button"
                    class="btn btn-circle btn-ghost pl-1"
                >
                    <ExclamationCircleIcon class="h-6 w-6" />
                </div>
                <ul
                    tabindex="0"
                    class="menu dropdown-content rounded-box bg-base-100 z-[1] mt-3 w-52 p-2"
                >
                    <li>
                        <button onclick="about_modal.showModal()">About</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="navbar-center">
            <a href="/" class="btn btn-ghost text-xl">SPK HP</a>
        </div>

        <div class="navbar-end">
            <div class="dropdown dropdown-end">
                <!-- <div
                    v-if="user.name"
                    tabindex="0"
                    role="button"
                    class="btn rounded-btn"
                >
                    {{ user.name }}
                </div> -->
                <ul
                    tabindex="0"
                    class="menu dropdown-content rounded-box bg-base-100 z-[1] mt-4 w-52 p-2"
                >
                    <li>
                        <form @submit.prevent="logout">
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <label class="swap swap-rotate mx-4">
                <!-- this hidden checkbox controls the state -->
                <input
                    type="checkbox"
                    class="theme-controller hidden"
                    :checked="currentTheme === 'dim'"
                    @change="toggleTheme"
                />
                <!-- sun icon -->
                <SunIcon class="swap-off size-5" />
                <!-- moon icon -->
                <MoonIcon class="swap-on size-5" />
            </label>
        </div>
    </div>
    <dialog id="about_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">About Encrypt It</h3>
            <p class="py-4">
                This is a simple web application that helps you encrypt and
                decrypt text using various encryption methods.
            </p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</template>
