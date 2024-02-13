<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link, usePage} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const showingNavigationDropdown = ref(false);

const authUser = usePage().props.auth.user;

</script>

<template>
    <div class="h-full">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 h-full">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <PrimaryButton>
                                    <a :href="route('login')">Login</a>
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="h-full overflow-auto">
                <slot/>
            </main>
        </div>
    </div>
</template>


<style scoped>


</style>
