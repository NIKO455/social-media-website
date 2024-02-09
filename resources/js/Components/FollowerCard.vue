<script setup>

defineProps({
    name: String,

})

</script>

<template>
    <div
        class="w-full sm:w-auto p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                 src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                 alt="Bonnie image"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{name}}</h5>
            <div class="flex mt-4 md:mt-6">
                <a href="#"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Follow</a>
                <a href="#"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700 ms-3">Message</a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
