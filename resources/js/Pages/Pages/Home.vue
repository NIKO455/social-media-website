<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import GroupList from "@/Pages/Group/GroupList.vue";
import FollowerList from "@/Pages/Page Components/FollowerList.vue";
import MainContent from "@/Pages/Page Components/MainContent.vue";

const {user, posts, groups} = defineProps({user: Object, posts: Object, groups: Object});

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-3 ml-3 mr-3 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 dark:text-white h-full">
                    <div
                        class="bg-[#1F2937] p-3 rounded-md md:overflow-auto lg:overflow-auto lg:h-[91%] md:h-[91%] hidden lg:block md:block">
                        <GroupList :groups="groups"/>
                    </div>

                    <div
                        class="bg-[#1F2937] p-3 rounded-md lg:col-span-2 md:col-span-2 lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto">
                        <MainContent :user="user" :posts="posts"/>
                    </div>

                    <div
                        class="bg-[#1F2937] p-3 rounded-md lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto hidden lg:block md:block">
                        <FollowerList/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>

<style scoped>
::-webkit-scrollbar {
    display: none;
}

</style>
