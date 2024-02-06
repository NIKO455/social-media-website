<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import GroupList from "@/Pages/Page Components/GroupList.vue";
import FollowerList from "@/Pages/Page Components/FollowerList.vue";
import MainContent from "@/Pages/Page Components/MainContent.vue";
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-10 ml-3 mr-3 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 dark:text-white">
                    <div class="bg-[#1F2937] p-3 rounded-md">
                        <GroupList/>
                    </div>

                    <div class="bg-[#1F2937] p-3 rounded-md lg:col-span-2 md:col-span-2">
                        <MainContent/>
                    </div>

                    <div class="bg-[#1F2937] p-3 rounded-md">
                        <FollowerList/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>
