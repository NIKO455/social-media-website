<script setup>

defineProps({
    name: String,
    image: String,
    role: String,
})

</script>

<template>
    <a :href="route('profile',$page.props.auth.user.username)"
       class="w-full sm:w-auto p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center">
            <div :class="[role === 'admin' ? 'admin-avatar' : 'user-avatar']">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover"
                     :src="image || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'"
                     alt="User image"/>
            </div>
            <h5 class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ name }}</h5>
            <div class="flex mt-1">
                <a href="#"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Follow</a>
                <a href="#"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700 ms-3">Message</a>
            </div>
        </div>
    </a>
</template>

<style scoped>
.admin-avatar {
    width: 7rem;
    height: 7rem;
    background-color: #ff0000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-avatar {
    width: 7rem;
    height: 7rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
