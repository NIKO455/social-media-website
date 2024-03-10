<script setup>
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import TabListItem from "@/Pages/Page Components/TabListItem.vue";
import AboutContainer from "@/Pages/Page Components/AboutContainer.vue";
import FollowersContainer from "@/Pages/Page Components/FollowersContainer.vue";
import VisitLayout from "@/Layouts/VisitLayout.vue";
import PostCardItem from "@/Components/PostCardItem.vue";

const {user} = defineProps({user: Object})

</script>

<template>
    <VisitLayout>
        <div class="py-3 ml-3 mr-3 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <div
                    class="mobile-profile-container bg-[#1F2937] rounded-md w-full lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto">
                    <div>
                        <div class="relative">
                            <!--  User Cover photo-->
                            <div class="relative">
                                <img
                                    :src="user.cover_url || 'https://generalassemb.ly/sites/default/files/styles/program_header_desktop_xxl_1x/public/2023-06/PT_AN_Header_0623.jpg?itok=83sR_pF_'"
                                    alt=""
                                    class="w-full h-[230px] object-cover rounded-tl-lg rounded-tr-lg cover-image">
                            </div>

                            <div class="w-full px-2 sm:px-0">
                                <TabGroup>
                                    <TabList
                                        class="relative nav-container flex gap-4 bg-[#1F2937] items-center ml-4 mr-4">
                                        <!-- profile image -->
                                        <div class="relative w-[204px] profile-edit">
                                            <img
                                                :src="user.avatar_url || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'"
                                                alt=""
                                                class="h-[150px] w-[150px] object-cover rounded-full mt-[-80px]">

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
                                    </TabList>

                                    <div class=" w-[97%] m-auto mb-4">
                                        <TabPanels class="mt-2">
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <AboutContainer :user="user"/>
                                            </TabPanel>
                                            <TabPanel
                                                :class="['rounded-xl bg-[#111827]    dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">

                                                <div
                                                    class="bg-[#1F2937] p-3  w-[40vw] m-auto rounded">
                                                    <div v-for="post in user.posts" :key="post.id">
                                                        <div v-if="post.body !== null || post.attachments.length > 0">
                                                            <PostCardItem :post="post" :user="user"/>
                                                        </div>
                                                    </div>
                                                </div>

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
    </VisitLayout>
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
        margin-top: -100px;
        right: -10px;
        width: auto;
    }

    .mobile-profile-container {
        height: 100%;

    }
}
</style>
