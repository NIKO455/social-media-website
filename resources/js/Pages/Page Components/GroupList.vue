<script setup>
import GroupItem from "@/Components/GroupItem.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    image: String,
    title: String,
    description: String
})
</script>

<template>
    <div class="h-full overflow-auto scrollbar">
        <h1 class="text-xl font-bold">My Groups</h1>
        <div class="py-5">
            <div v-if="false" class="text-sm text-gray-500 dark:text-gray-500">
                You are not in any groups!
            </div>
            <div v-else class="text-sm dark:text-white">
                <TextInput type="text" class="w-full mb-4 bg-gray-700 dark:bg-gray-800 rounded-md" placeholder="Search for groups" model-value=""/>

                <GroupItem image="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg"
                           title="Laravel Developer"
                           description="Laravel developer are one of the best person in the whole world."/>
                <GroupItem image="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg"
                           title="Vue Developer"
                           description="Laravel developer are one of the best person in the whole world."/>
                <GroupItem image="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg"
                           title="JavaScript Developer"
                           description="Laravel developer are one of the best person in the whole world."/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
