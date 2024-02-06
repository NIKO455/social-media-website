<script setup>
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";

defineProps({
    avatar: String,
    name: String,
    date: String,
    description: String,
    post_group: String,
})

const post1 = {
    attachments: [
        {
            'id': 1,
            'name': 'test.png',
            'url': 'https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg',
            'mime': 'image/png'
        },
        {
            'id': 2,
            'name': 'test.png',
            'url': 'https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg',
            'mime': 'image/png'
        },
        {
            'id': 3,
            'name': 'MyDocument.docx',
            'url': '#',
            'mime': 'document/docx'
        }
    ]
}

function isImage(attachment) {
    const mime = attachment.mime.split('/');
    return mime[0].toLowerCase() === 'image';
}


</script>

<template>
    <div class="mt-10">
        <div class="flex gap-3">
            <img v-if="avatar" :src="avatar" alt="group-image"
                 class="h-12 w-12 rounded-full object-cover cursor-pointer">
            <div>
                <div class="text-[16px] font-bold pb-1 flex items-center ">
                    <p class="hover:underline cursor-pointer">
                        {{ name }}
                    </p>
                    <template v-if="post_group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                        <span class="text-green-500 hover:underline cursor-pointer"> {{ post_group }}</span>
                    </template>
                </div>
                <p class="mt-[-5px] text-sm text-gray-400">{{ date }}</p>
            </div>
        </div>
        <div class="pl-2 pr-2 mt-2">
            <Disclosure v-slot="{ open }">
                <span v-if="!open" v-html="description.substring(0,150)" class="mr-2"/>
                <DisclosurePanel>
                    <span v-html="description"/>
                </DisclosurePanel>
                <DisclosureButton>
                <span class="text-[13px] text-blue-600 hover:underline">
                    {{ open ? 'Read Less' : 'Read More' }}
                </span>
                </DisclosureButton>
            </Disclosure>
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-3">
            <div v-if="post1.attachments" v-for="attachment in post1.attachments" :key="attachment.id"
                 class="w-full h-[200px]">
                <img v-if="isImage(attachment)" :src="attachment.url" alt="attachments image"
                     class="h-full w-full object-cover mt-2 rounded">
                <div v-else
                     class="relative lg:mt-2 bg-blue-100 text-gray-500 mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-gray-500 h-full w-full flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 absolute top-3 right-3 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    {{ attachment.name }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 mt-5 border-t-2 border-b-2 pt-1 pb-1 border-gray-300">
            <button class="flex items-center justify-center gap-2 w-full hover:bg-[#111827] p-1 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path
                        d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z"/>
                </svg>
                Like
            </button>
            <button class="flex items-center justify-center gap-2 w-full hover:bg-[#111827] p-1 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path
                        d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z"/>
                    <path
                        d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z"/>
                </svg>
                Comment
            </button>
            <button class="flex items-center justify-center gap-2 w-full hover:bg-[#111827] p-1 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                </svg>
                Share
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
