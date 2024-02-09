<script setup>

import FollowerCard from "@/Components/FollowerCard.vue";
</script>

<template>

    <div class="flex justify-between flex-wrap items-center gap-2">
        <FollowerCard :name="'John Doe'"/>
        <FollowerCard :name="'Ram Shah'"/>
        <FollowerCard :name="'Sita Devi'"/>
        <FollowerCard :name="'Bishal Gautam'"/>
        <FollowerCard :name="'Suraj Bista'"/>
    </div>

</template>

<style scoped>

</style>
