<script setup>
defineProps({
    image: String,
    title: String,
    description: String
})
</script>

<template>
    <div class="flex items-center gap-3 p-2 hover:bg-[#111827] cursor-pointer rounded-md">
        <img :src="image" alt="group-image"
             class="h-12 w-12 rounded-full object-cover">
        <div>
            <p class="text-[16px] font-bold pb-1">{{ title }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
