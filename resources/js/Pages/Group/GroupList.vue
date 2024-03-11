<script setup>
import GroupItem from "@/Components/GroupItem.vue";
import TextInput from "@/Components/TextInput.vue";
import {Link, router, useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive, ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";

let showCreateGroup = ref(false);

defineProps({
    groups: Object,
    image: String,
    title: String,
    description: String
})

const form = useForm({
    name: null,
    description: null,
    auto_approval: true,
})


const createGroup = () => {
    showCreateGroup.value = true;
}

const closeModal = () => {
    showCreateGroup.value = false;
}

function submit(){
    form.post(route('group.store'), {
        onSuccess: () => {
            form.name = null
            form.description = null
            form.auto_approval = true
            showCreateGroup.value = false
        }
    })
}

</script>

<template>
    <div class="h-full">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">My Groups</h1>
            <a @click="createGroup" class="text-sm text-blue-500 cursor-pointer">New group</a>
        </div>
        <Modal :show="showCreateGroup" @close="closeModal">
            <div class="bg-gray-700 p-5">
                <div class="relative">
                    <h1 class="pb-1 text-xl text-center font-bold dark:text-white">Create Group</h1>
                    <button
                        class="ms-3 absolute top-[-10px] right-0 bg-gray-600 dark:text-white p-2 rounded-full"
                        @click="closeModal"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <hr class="my-2">
                <InputLabel class="mb-1 ml-1">Group Name</InputLabel>
                <TextInput type="text" class="w-full mb-4 bg-gray-700 dark:bg-gray-800 rounded-md"
                           placeholder="Group name" v-model="form.name"/>

                <div class="flex gap-3 items-center mb-2 mt-1">
                    <InputLabel class="mb-1 ml-1">Enable Auto Approval</InputLabel>
                    <Checkbox checked="checked" v-model="form.auto_approval" class="h-5 w-5"></Checkbox>
                </div>

                <InputLabel class="mb-1 ml-1">Group Description</InputLabel>
                <TextArea type="text" class="w-full mb-4 bg-gray-700 dark:bg-gray-800 rounded-md"
                          placeholder="Group description" v-model="form.description"/>

                <PrimaryButton @click="submit">Create Group</PrimaryButton>
            </div>
        </Modal>
        <div class="py-5">
            <div v-if="false" class="text-sm text-gray-500 dark:text-gray-500">
                You are not in any groups!
            </div>
            <div v-else class="text-sm dark:text-white">
                <TextInput type="text" class="w-full mb-4 bg-gray-700 dark:bg-gray-800 rounded-md"
                           placeholder="Search for groups" model-value=""/>

                <div v-for="group in groups">
                    <GroupItem :slug="group.slug"
                               :image="group.group_profile || 'https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg'"
                               :title="group.name" :description="group.description"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
