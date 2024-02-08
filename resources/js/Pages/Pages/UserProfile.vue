<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({user: Object})

const categories = ref({
    About: [
        {
            id: 1,
            title: 'Does drinking coffee make you smarter?',
            date: '5h ago',
            commentCount: 5,
            shareCount: 2,
        },
        {
            id: 2,
            title: "So you've bought coffee... now what?",
            date: '2h ago',
            commentCount: 3,
            shareCount: 2,
        },
    ],
    Posts: [
        {
            id: 1,
            title: 'Is tech making coffee better or worse?',
            date: 'Jan 7',
            commentCount: 29,
            shareCount: 16,
        },
        {
            id: 2,
            title: 'The most innovative things happening in coffee',
            date: 'Mar 19',
            commentCount: 24,
            shareCount: 12,
        },
    ],
    Followers: [
        {
            id: 1,
            title: 'Ask Me Anything: 10 answers to your questions about coffee',
            date: '2d ago',
            commentCount: 9,
            shareCount: 5,
        },
        {
            id: 2,
            title: "The worst advice we've ever heard about coffee",
            date: '4d ago',
            commentCount: 1,
            shareCount: 2,
        },
    ],
    Followings: [
        {
            id: 1,
            title: 'Ask Me Anything: 10 answers to your questions about coffee',
            date: '2d ago',
            commentCount: 9,
            shareCount: 5,
        },
        {
            id: 2,
            title: "The worst advice we've ever heard about coffee",
            date: '4d ago',
            commentCount: 1,
            shareCount: 2,
        },
    ],
    Photos: [
        {
            id: 1,
            title: 'Ask Me Anything: 10 answers to your questions about coffee',
            date: '2d ago',
            commentCount: 9,
            shareCount: 5,
        },
        {
            id: 2,
            title: "The worst advice we've ever heard about coffee",
            date: '4d ago',
            commentCount: 1,
            shareCount: 2,
        },
    ]

})
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3 ml-3 mr-3 h-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <div
                    class="bg-[#1F2937] rounded-md w-full lg:h-[91%] md:h-[91%] md:overflow-auto lg:overflow-auto">
                    <div>
                        <div class="relative">
                            <!--  User Cover photo-->
                            <img
                                src="https://images.pexels.com/photos/268941/pexels-photo-268941.jpeg"
                                alt="" class="w-full h-[230px] object-cover rounded-tl-lg rounded-tr-lg">

                            <div class="w-full px-2 sm:px-0">
                                <TabGroup>
                                    <TabList class="flex gap-4 bg-[#1F2937] items-center ml-4 mr-4">
                                        <img
                                            src="https://images.pexels.com/photos/1243046/pexels-photo-1243046.jpeg?cs=srgb&dl=pexels-mixu-1243046.jpg&fm=jpg"
                                            alt=""
                                            class="h-[150px] w-[150px] object-cover rounded-full mt-[-80px]">
                                        <div class="flex w-full space-x-1 rounded-xl bg-blue-900/20 h-[40px]">
                                            <Tab
                                                v-for="category in Object.keys(categories)"
                                                as="template"
                                                :key="category"
                                                v-slot="{ selected }"
                                            >
                                                <button
                                                    :class="[
              'w-full rounded-lg h-[40px] text-sm font-medium leading-5',
              'ring-white/60 ring-offset-0  focus:outline-none focus:ring-0',
              selected
                ? 'bg-white text-blue-700 shadow'
                : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
            ]"
                                                >
                                                    {{ category }}
                                                </button>
                                            </Tab>
                                        </div>
                                        <PrimaryButton v-if="user.id === $page.props.user.id" class="w-40">
                                            <a :href="route('profile.edit')">Edit Profile</a>
                                        </PrimaryButton>
                                    </TabList>

                                    <div class=" w-[97%] m-auto">
                                        <TabPanels class="mt-2">
                                            <TabPanel
                                                v-for="(posts, idx) in Object.values(categories)"
                                                :key="idx"
                                                :class="[
            'rounded-xl bg-[#111827] dark:text-white p-3',
            'ring-white/60 ring-offset-0 focus:outline-none focus:ring-0',
          ]"
                                            >
                                                <ul>
                                                    <li
                                                        v-for="post in posts"
                                                        :key="post.id"
                                                        class="relative rounded-md p-3 hover:bg-[#1F2937]"
                                                    >
                                                        <h3 class="text-sm font-medium leading-5">
                                                            {{ post.title }}
                                                        </h3>

                                                        <ul
                                                            class="mt-1 flex space-x-1 text-xs font-normal leading-4 text-gray-500"
                                                        >
                                                            <li>{{ post.date }}</li>
                                                            <li>&middot;</li>
                                                            <li>{{ post.commentCount }} comments</li>
                                                            <li>&middot;</li>
                                                            <li>{{ post.shareCount }} shares</li>
                                                        </ul>

                                                        <a
                                                            href="#"
                                                            :class="[
                  'absolute inset-0 rounded-md',
                  'ring-blue-400 focus:z-10 focus:outline-none focus:ring-2',
                ]"
                                                        />
                                                    </li>
                                                </ul>
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
</style>
