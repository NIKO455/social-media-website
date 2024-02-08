<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({user: Object})

</script>

<template>
    {{ user }}
    <h1>I am in AuthenticatedLayout</h1>


</template>

<style scoped>

</style>
