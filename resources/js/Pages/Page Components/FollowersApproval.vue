<script setup>

import ApprovalCard from "@/Components/ApprovalCard.vue";

defineProps({user: Object});

</script>

<template>

    <div class="flex justify-between flex-wrap items-center gap-2" v-for="u in user" v-if="user.length > 0">
        <ApprovalCard :name="u.member_name" :image="u.avatar_path || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'" :id="u.id"/>
    </div>

    <div class="flex justify-between flex-wrap items-center gap-2" v-else>
        <p>No member found</p>
    </div>

</template>

<style scoped>

</style>
