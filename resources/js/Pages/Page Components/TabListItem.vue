<script setup>

defineProps({
    category: String,
    selected: Boolean
})

</script>

<template>
    <button
        :class="[ 'w-full rounded-lg h-[40px] text-sm font-medium leading-5', 'ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',selected
                                                    ? 'bg-white text-blue-700 shadow'
                                                    : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',]">
        {{ category }}
    </button>
</template>

<style scoped>

</style>
