<script setup>

import {router} from "@inertiajs/vue3";


const props = defineProps({
    name: String,
    image: String,
    id: Number
})

const AcceptRequest = (id) => {
    router.post('/group/accept/' + id)
}

const RejectRequest = (id) => {
    router.post('/group/reject/' + id)
}


</script>

<template>
    <a
        class="w-full sm:w-auto p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center">
            <div class="user-avatar">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover"
                     :src="image"
                     alt="User image"/>
            </div>
            <h5 class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ name }}</h5>
            <div class="flex mt-1">
                <a @click="AcceptRequest(id)"
                   class="hover:cursor-pointer inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accept</a>
                <a @click="RejectRequest(id)"
                   class="hover:cursor-pointer  inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700 ms-3">Reject</a>
            </div>
        </div>
    </a>
</template>

<style scoped>

.user-avatar {
    width: 7rem;
    height: 7rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
