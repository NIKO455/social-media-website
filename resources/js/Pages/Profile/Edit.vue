<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {ref} from "vue";


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    }
});

const defaultOpen = ref(true);
</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Profile</h2>
        </template>

        <div class="py-4 mb-[70px]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 overflow-auto">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <Disclosure :defaultOpen="defaultOpen" v-slot="{ open }">
                        <DisclosureButton>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Personal Information</h2>
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="max-w-xl"
                            />
                        </DisclosurePanel>
                    </Disclosure>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <Disclosure v-slot="{ open }">
                        <DisclosureButton>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Update Password</h2>
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                            <UpdatePasswordForm class="max-w-xl"/>
                        </DisclosurePanel>
                    </Disclosure>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <Disclosure v-slot="{ open }">
                        <DisclosureButton>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Remove Account</h2>
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                            <DeleteUserForm class="max-w-xl"/>
                        </DisclosurePanel>
                    </Disclosure>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
