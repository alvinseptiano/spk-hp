<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="mt-6 flex flex-col gap-4">
            <h2 class="divider text-xl font-bold">Akun</h2>
            <div class="grid grid-cols-3 justify-between gap-4">
                <div class="relative col-span-2 overflow-auto">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl pl-2"
                    />
                    <UpdatePasswordForm class="my-8 max-w-xl pl-2" />
                    <DeleteUserForm class="max-w-xl pl-2" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
