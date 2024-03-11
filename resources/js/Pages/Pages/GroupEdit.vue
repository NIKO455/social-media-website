<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {ref} from "vue";
import UpdateGroupInformationForm from "@/Pages/Group/Partials/UpdateGroupInformationForm.vue";


defineProps({
    group: Object,
});

const defaultOpen = ref(true);
</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Group Edit</h2>
        </template>

        <div class="py-4 mb-[70px]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 overflow-auto">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <Disclosure :defaultOpen="defaultOpen" v-slot="{ open }">
                        <DisclosureButton>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Group Information</h2>
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                            <UpdateGroupInformationForm
                                :group = 'group'
                            />
                        </DisclosurePanel>
                    </Disclosure>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
