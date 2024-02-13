<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import TabListItem from "@/Pages/Page Components/TabListItem.vue";
import AboutContainer from "@/Pages/Page Components/AboutContainer.vue";
import FollowersContainer from "@/Pages/Page Components/FollowersContainer.vue";

defineProps({user: Object})


</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3 ml-3 mr-3 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <div
                    class="mobile-profile-container bg-[#1F2937] rounded-md w-full lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto">
                    <div>
                        <div class="relative">
                            <!--  User Cover photo-->
                            <img
                                src="https://images.pexels.com/photos/268941/pexels-photo-268941.jpeg"
                                alt="" class="w-full h-[230px] object-cover rounded-tl-lg rounded-tr-lg cover-image">

                            <div class="w-full px-2 sm:px-0">
                                <TabGroup>
                                    <TabList
                                        class="relative nav-container flex gap-4 bg-[#1F2937] items-center ml-4 mr-4">
                                        <!-- profile image -->
                                        <img
                                            src="https://images.pexels.com/photos/1243046/pexels-photo-1243046.jpeg?cs=srgb&dl=pexels-mixu-1243046.jpg&fm=jpg"
                                            alt=""
                                            class="h-[150px] w-[150px] object-cover rounded-full mt-[-80px]">

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
                                                       class="w-40 profile-edit-button">
                                            <a :href="route('profile.edit')">Edit Profile</a>
                                        </PrimaryButton>
                                    </TabList>

                                    <div class=" w-[97%] m-auto mb-4">
                                        <TabPanels class="mt-2">
                                            <TabPanel :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <AboutContainer :user="user"/>
                                            </TabPanel>
                                            <TabPanel :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                This is post section
                                            </TabPanel>
                                            <TabPanel :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
                                                <FollowersContainer :user="user"/>
                                            </TabPanel>
                                            <TabPanel :class="['rounded-xl bg-[#111827] dark:text-white p-3','ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',]">
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

    .cover-image {
        height: 190px;
    }

    .nav-container img {
        margin-top: -150px;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0);
        height: 130px;
        width: 130px;
        border: 5px solid #13137f;
    }

    .profile-edit-button {
        position: absolute;
        margin-top: -100px;
        right: -10px;
        width: 130px;
    }

    .mobile-profile-container {
        height: 100%;

    }
}
</style>
