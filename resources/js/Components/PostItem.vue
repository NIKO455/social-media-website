<script setup>
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InfoButton from "@/Components/InfoButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";

const form = useForm({})

const {user, post} = defineProps({
    user: Object,
    post: Object,
})


const showCreatePost = ref(false);

const createPost = () => {
    showCreatePost.value = true;
}

const closeModal = () => {
    showCreatePost.value = false;
}


let postFiles = [];
const postOldFileSrc = ref(post.attachments ?? []);
const postFileSrc = ref('');

const updateForm = useForm({
    body: post.body,
    files: null,
});

function postSelectFile(event) {
    const maxFiles = 2;
    const files = Array.from(event.target.files).slice(0, maxFiles);
    postFiles = files;
    updateForm.files = files;

    files.forEach((file) => {
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                postFileSrc.value = [...postFileSrc.value, reader.result];
            };
            reader.readAsDataURL(file);
        }
    });
}

function removeImage(index) {
    this.postFileSrc.splice(index, 1);
    this.postFiles.splice(index, 1);
    updateForm.files = postFiles
}


function removeOldImage(index, src) {
    form.delete((`/delete/assets/${src.id}`), {
        onSuccess: () => {
            console.log("done")
        },
    });
    postOldFileSrc.value.splice(index, 1);
    postFiles.splice(index, 1);
    updateForm.files = postFiles;
}

function submitPost(slug) {
    updateForm.post(`update/post/${slug}`, {
        onSuccess: () => {
            closeModal();
            updateForm.body = '';
            postFiles = [];
            postOldFileSrc.value = [];
        },
    });
}


function deletePost(slug) {
    form.delete((`/delete/post/${slug}`), {
        onSuccess: () => {
            console.log("done")
        },
    });
}


const isImage = (attachment) => {
    return attachment.mime.includes('jpg') || attachment.mime.includes('jpeg') || attachment.mime.includes('png') || attachment.mime.includes('gif');
};


</script>

<template>


    <Modal :show="showCreatePost" @close="closeModal">
        <div class="bg-gray-700 p-5">
            <div class="relative">
                <h1 class="pb-1 text-xl text-center font-bold dark:text-white">Edit Post</h1>
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
            <div class="flex items-center mb-5">
                <img
                    :src="user.avatar_url || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'"
                    alt=""
                    class="h-12 w-12 object-cover rounded-full"
                >
                <Link :href="route('profile',$page.props.auth.user.username)">
                    <p class="ml-3 font-bold dark:text-white">{{ user.name }}</p>
                </Link>
            </div>

            <div class="flex align-center gap-2">
                <div v-if="postOldFileSrc.length">
                    <h1 class="text-sm dark:text-green-600 mb-1">Old Files</h1>
                    <div v-if="postOldFileSrc.length" class="flex flex-wrap gap-2">
                        <template v-for="(src, index) in postOldFileSrc" :key="index">
                            <div class="relative">
                                <img
                                    :src="src.path || src || user.cover_url || 'https://generalassemb.ly/sites/default/files/styles/program_header_desktop_xxl_1x/public/2023-06/PT_AN_Header_0623.jpg?itok=83sR_pF_'"
                                    alt="image"
                                    class="w-[150px] h-[150px] object-cover rounded cover-image"
                                />
                                <button @click="removeOldImage(index, src)"
                                        class="absolute top-2 right-2 bg-red-600 text-white p-[5px] rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <div v-if="postFileSrc.length">
                    <h1 class="text-sm dark:text-white mb-1">New Files</h1>
                    <div v-if="postFileSrc.length" class="flex flex-wrap gap-2">
                        <template v-for="(src, index) in postFileSrc" :key="index">
                            <div class="relative">
                                <img
                                    :src="src || user.cover_url || 'https://generalassemb.ly/sites/default/files/styles/program_header_desktop_xxl_1x/public/2023-06/PT_AN_Header_0623.jpg?itok=83sR_pF_'"
                                    alt=""
                                    class="w-[150px] h-[150px] object-cover rounded cover-image"
                                />
                                <button @click="removeImage(index)"
                                        class="absolute top-2 right-2 bg-red-600 text-white p-[5px] rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

            </div>


            <textarea
                class="w-full border-none dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:border-none dark:focus:border-none focus:ring-0 dark:focus:ring-0 rounded-md shadow-sm"
                ref="input"
                placeholder="What's in your mind, Bhupendra?"
                v-model="updateForm.body"
            ></textarea>
            <div class="flex justify-end">
                <InfoButton class="ms-3 relative bg-red-600">
                    Choose File
                    <input type="file" name="file" id="file"
                           class="absolute opacity-0 w-[92px] hover:cursor-pointer" @change="postSelectFile"
                           multiple>
                </InfoButton>
                <PrimaryButton class="ms-3" @click="submitPost(post.slug)">Update</PrimaryButton>
            </div>
        </div>
    </Modal>


    <div class="mt-10">
        <div class="flex align-item justify-between">
            <div class="flex gap-3">
                <img
                    :src="user.avatar_url || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'"
                    class="w-12 h-12 rounded-full object-cover" alt="user-image cursor-pointer"
                >
                <div>
                    <div class="text-[15px] font-bold pb-1 flex items-center ">
                        <p class="hover:underline cursor-pointer">
                            <Link :href="route('profile',$page.props.auth.user.username)">
                                {{ user.name }}
                            </Link>
                        </p>
                        <template v-if="post.group_id">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                            </svg>
                            <span class="text-green-500 hover:underline cursor-pointer">hacker</span>
                        </template>
                    </div>
                    <p class="mt-[-5px] text-sm text-gray-400">{{ post.created_at }}</p>
                </div>
            </div>
            <div class="relative">
                <Menu>
                    <MenuButton>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"/>
                        </svg>
                    </MenuButton>
                    <MenuItems class="flex flex-col absolute bg-[#111827] right-2 w-40 rounded">
                        <MenuItem v-slot="{ active }" class="p-3 text-sm hover:rounded hover:bg-gray-700">
                            <a :class='{ "bg-blue-500": active }' @click="createPost">
                                Edit Post
                            </a>
                        </MenuItem>
                        <MenuItem v-slot="{ active }"
                                  class="p-3 text-sm hover:rounded hover:bg-gray-700 cursor-pointer">
                            <a :class='{ "bg-blue-500": active }' @click="deletePost(post.slug)">
                                Delete Post
                            </a>
                        </MenuItem>
                    </MenuItems>
                </Menu>
            </div>
        </div>
        <div class="pl-2 pr-2 mt-2" v-if="post.body">
            <Disclosure v-slot="{ open }">
                <span v-if="!open" v-html="post.body.substring(0,90)" class="mr-2"/>
                <DisclosurePanel>
                    <span v-html="post.body"/>
                </DisclosurePanel>
                <DisclosureButton>
                <span class="text-[13px] text-blue-600 hover:underline" v-if="post.body.length > 90">
                    {{ open ? 'Read Less' : 'Read More' }}
                </span>
                </DisclosureButton>
            </Disclosure>
        </div>

        <div>
            <div v-if="post.attachments.length" class="mt-4">
                <div v-if="post.attachments.length === 1">
                    <div>
                        <div v-for="attachment in post.attachments" :key="attachment.id"
                             class="w-full h-[300px] mt-2">
                            <a :href="attachment.path" :data-lightbox="'post-' + post.id" class="flex items-center justify-center">
                                <img v-if="isImage(attachment)" :src="attachment.path" alt="no-image" class="h-[300px] w-auto object-fill rounded">
                                <video v-else>
                                    <source :src="attachment.path" type="video/mp4">
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="grid grid-cols-2 gap-3">
                        <div v-for="attachment in post.attachments" :key="attachment.id"
                             class="w-full h-[300px] mt-2">
                            <a :href="attachment.path" :data-lightbox="'post-' + post.id" class="flex items-center justify-center">
                                <img v-if="isImage(attachment)" :src="attachment.path" alt="no-image" class="h-[300px] w-auto object-cover rounded">
                                <video v-else>
                                    <source :src="attachment.path" type="video/mp4">
                                </video>
                            </a>
                        </div>
                    </div>
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

<style>

.lb-data .lb-close {
    position: absolute !important;
    top: -34px !important;
}

.lightbox .lb-image {
    width: auto !important;
    object-fit: cover;
    height: 500px !important;
}
textarea {
    min-height: 100px;
    resize: none;
}

</style>
