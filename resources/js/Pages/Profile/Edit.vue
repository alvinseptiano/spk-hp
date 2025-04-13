<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
// import DangerButton from '@/Components/DangerButton.vue';
const page = usePage();

const logout = () => {
    router.post('/logout', {
        _token: page.props.csrf_token,
    });
};

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
                <div class="relative flex gap-4 overflow-auto">
                    <h2 class="text-lg font-medium">Sign off:</h2>
                    <div class="btn btn-error" @click="logout">Logout</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
