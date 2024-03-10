<script setup>
defineProps({
    image: String,
    title: String,
    description: String,
    slug: String
})
</script>

<template>
    <a :href="'/g/' + slug">
        <div class="flex gap-3 p-2 hover:bg-[#111827] cursor-pointer rounded-md">
            <img :src="image" alt="group-image"
                 class="h-12 w-12 rounded-full object-cover">
            <div>
                <p class="text-[16px] font-bold pb-1">{{ title }}</p>
                <p>
                    {{ description.length > 50 ? description.slice(0, 50) + '...' : description }}
                </p>

            </div>
        </div>
    </a>
</template>

<style scoped>

</style>
