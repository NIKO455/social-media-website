<script setup>
defineProps({
    image: String,
    name: String,
    date: String,
    description: String
})
</script>

<template>
    <div class="mt-10">
        <div class="flex gap-3">
            <img v-if="image" :src="image" alt="group-image"
                 class="h-12 w-12 rounded-full object-cover">
            <div>
                <p class="text-[16px] font-bold pb-1">{{ name }}</p>
                <p class="mt-[-5px] text-sm text-gray-400">{{ date }}</p>
            </div>
        </div>
        <p class="mt-3">{{ description }}</p>
        <img :src="image" alt="" class="h-42 w-full object-cover mt-2 rounded">
    </div>
</template>

<style scoped>

</style>
