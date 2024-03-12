<script setup>

import FollowerCard from "@/Components/FollowerCard.vue";

defineProps({user: Object});

</script>

<template>
    <div class="flex justify-between flex-wrap items-center gap-2" v-for="u in user" v-if="user.length > 0">
        <FollowerCard :name="u.member_name" :image ="u.avatar_path" :role="u.role"/>
    </div>

    <div class="flex justify-between flex-wrap items-center gap-2" v-else>
        <p>No member found</p>
    </div>

</template>

<style scoped>

</style>
