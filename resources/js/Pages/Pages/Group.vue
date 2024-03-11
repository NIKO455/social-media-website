<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import {ref} from "vue";
import {useForm} from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import TabListItem from "@/Pages/Page Components/TabListItem.vue";
import AboutContainer from "@/Pages/Page Components/AboutContainer.vue";
import FollowersContainer from "@/Pages/Page Components/FollowersContainer.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import DropdownLinkButton from "@/Components/DropdownLinkButton.vue";
import MainContent from "@/Pages/Page Components/MainContent.vue";
import PostCardItem from "@/Components/PostCardItem.vue";
import GroupContainer from "@/Pages/Page Components/GroupContainer.vue";

const {group} = defineProps({group: Object})

let coverImageFile = null;
let profileImageFile = null;
const coverImageSrc = ref('');
const profileImageSrc = ref('');

const coverForm = useForm({
    cover_path: null,
})

const form = useForm({
    profile_path: null,
})

function uploadCoverImage(event) {
    coverImageFile = event.target.files[0];
    coverForm.cover_path = coverImageFile;
    if (coverImageFile) {
        const reader = new FileReader();
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(coverImageFile);
    }
}

function uploadProfileImage(event) {
    profileImageFile = event.target.files[0];
    form.profile_path = profileImageFile;
    if (profileImageFile) {
        const reader = new FileReader();
        reader.onload = () => {
            profileImageSrc.value = reader.result;
        }
        reader.readAsDataURL(profileImageFile);
    }
    form.post(`/group/profile/update/${group.id}`)

}

function cancelCoverImage() {
    coverImageFile = null;
    coverImageSrc.value = null;
}


function submitCoverImage() {
    coverForm.post((`/group/cover/update/${group.id}`), {
        onSuccess: () => {
            coverImageSrc.value = null;
        }
    });
}


</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3 ml-3 mr-3 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <div
                    class="mobile-profile-container bg-[#1F2937] rounded-md w-full lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto">
                    <div>
                        <div class="relative">
                            <!--  group Cover photo-->
                            <div class="relative">
                                <img
                                    :src="coverImageSrc || group.group_cover || 'https://png.pngtree.com/thumb_back/fh260/back_our/20190620/ourmid/pngtree-taobao-children-s-education-group-buy-poster-banner-background-image_159575.jpg'"
                                    alt=""
                                    class="w-full h-[230px] object-cover rounded-tl-lg rounded-tr-lg cover-image">
                                <div class="absolute right-5 top-5 w-full">
                                    <button v-if="!coverImageSrc"
                                            class="cursor-pointer lg:block md:block absolute right-0 top-0 hidden items-center px-2 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                    >
                                        <div class="flex items-center gap-1 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
                                            </svg>
                                            Change Cover Image
                                            <input type="file" @change="uploadCoverImage"
                                                   class="absolute top-2 right-2 w-[158px] opacity-0 cursor-pointer">
                                        </div>
                                    </button>

                                    <PrimaryButton v-if="!coverImageSrc"
                                                   class="absolute top-[-10px] right-[-8px] flex items-center gap-1 lg:hidden md:hidden">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
                                            </svg>
                                            <input type="file" @change="uploadCoverImage"
                                                   class="absolute top-2 right-2 w-[158px] opacity-0 cursor-pointer">
                                        </button>
                                    </PrimaryButton>

                                    <template v-else>
                                        <button @click="cancelCoverImage"
                                                class="cursor-pointer absolute  top-[-10px] right-[40px] md:right-24 lg:right-24 lg:block md:block flex items-center px-2 py-2 bg-red-700 dark:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-red-800 dark:hover:bg-red-800 focus:bg-red-700 dark:focus:bg-red-600 active:bg-red-900 dark:active:bg-red-700 focus:outline-none focus:ring-0 focus:ring-offset-0 dark:focus:ring-offset-0 transition ease-in-out duration-150"
                                        >
                                            <div class="flex items-center gap-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <div class="hidden lg:block md:block">
                                                    Cancel
                                                </div>
                                            </div>
                                        </button>
                                        <button
                                            @click="submitCoverImage"
                                            class="cursor-pointer absolute top-[-10px] right-[-8px] lg:block md:block flex items-center px-2 py-2 bg-green-700 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-green-800 dark:hover:bg-green-800 focus:bg-green-700 dark:focus:bg-green-600 active:bg-green-900 dark:active:bg-green-700 focus:outline-none focus:ring-0 focus:ring-offset-0 dark:focus:ring-offset-0 transition ease-in-out duration-150"
                                        >
                                            <div class="flex items-center gap-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <div class="hidden lg:block md:block">
                                                    Submit
                                                </div>
                                            </div>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="w-full px-2 sm:px-0">
                                <TabGroup>
                                    <TabList
                                        class="relative nav-container flex gap-4 bg-[#1F2937] items-center ml-4 mr-4">
                                        <!-- profile image -->
                                        <div class="relative w-[204px] profile-edit">
                                            <img
                                                :src="profileImageSrc || group.group_profile || 'https://as2.ftcdn.net/v2/jpg/06/08/22/35/1000_F_608223571_kK7unat5zGjADbMqAKUZK0yBoU93LbHG.jpg'"
                                                alt=""
                                                class="h-[150px] w-[150px] object-cover rounded-full mt-[-80px]">

                                            <Dropdown align="right bg-transparent" width="48">
                                                <template #trigger>
                                                    <button
                                                        class="absolute top-[-3.5rem] right-[0px] bg-white p-2 rounded-full flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
                                                        </svg>
                                                    </button>
                                                </template>

                                                <template #content>
                                                    <DropdownLinkButton>
                                                        <div class="relative">
                                                            <input type="file" name="profile" id="file"
                                                                   class="absolute opacity-0"
                                                                   @change="uploadProfileImage">
                                                            Change Profile
                                                        </div>
                                                    </DropdownLinkButton>
                                                    <DropdownLink
                                                        :href="route('group.profile.remove', group.id)"
                                                        method="delete" as="button">
                                                        Remove Profile
                                                    </DropdownLink>
                                                </template>
                                            </Dropdown>
                                        </div>

                                        <div
                                            class="flex w-full space-x-1 rounded-xl bg-blue-900/20 h-[40px] sm:w-full profiles-links">
                                            <Tab as="template" v-slot="{ selected }">
                                                <TabListItem :category="'About'" :selected="selected"/>
                                            </Tab>
                                            <Tab as="template" v-slot="{ selected }">
                                                <TabListItem :category="'Posts'" :selected="selected"/>
                                            </Tab>
                                            <Tab as="template" v-slot="{ selected }">
                                                <TabListItem :category="'Followers'" :selected="selected"/>
                                            </Tab>
                                            <Tab as="template" v-slot="{ selected }">
                                                <TabListItem :category="'Followings'" :selected="selected"/>
                                            </Tab>
                                        </div>
                                        <PrimaryButton
                                            class="w-40 desktop-edit-btn">
                                            <a :href="route('profile.edit')">Edit Group</a>
                                        </PrimaryButton>

                                        <PrimaryButton class="lg:hidden md:hidden profile-edit-button">
                                            <a :href="route('profile.edit')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                                </svg>
                                            </a>
                                        </PrimaryButton>
                                    </TabList>

                                    <div class=" w-[97%] m-auto mb-4">
                                        <TabPanels class="mt-2">
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <GroupContainer :group="group"/>
                                            </TabPanel>
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                Post
                                            </TabPanel>
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <FollowersContainer :user="user"/>
                                            </TabPanel>
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <FollowersContainer :user="user"/>
                                            </TabPanel>
                                        </TabPanels>
                                    </div>
                                </TabGroup>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
::-webkit-scrollbar {
    display: none;
}

@media (max-width: 768px) {
    .nav-container {
        margin-top: 20px;
        display: block;
    }

    .desktop-edit-btn {
        display: none;
    }

    .cover-image {
        height: 190px;
    }

    .profile-edit {
        margin-top: -100px;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0);
        height: 130px;
        width: 155px;
    }

    .profile-edit-button {
        position: absolute;
        margin-top: -110px;
        right: -10px;
        width: auto;
    }

    .mobile-profile-container {
        height: 100%;

    }
}
</style>
