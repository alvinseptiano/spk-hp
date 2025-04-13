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
            <div class="relative overflow-auto">
                <div class="mb-10 flex gap-4">
                    <h2 class="text-lg font-medium">Sign Out Account:</h2>
                    <div class="btn btn-error" @click="logout">Logout</div>
                </div>
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl pl-2"
                />
                <UpdatePasswordForm class="my-8 max-w-xl pl-2" />
                <DeleteUserForm class="max-w-xl pl-2" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
