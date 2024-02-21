<script setup>
import {ref} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PostItem from "@/Components/PostItem.vue";
import InfoButton from "@/Components/InfoButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const {user, posts} = defineProps({
    user: Object,
    posts: Object
})

const showCreatePost = ref(false);

const createPost = () => {
    showCreatePost.value = true;
}

const closeModal = () => {
    showCreatePost.value = false;
}

let postFiles = [];
const postFileSrc = ref('');

const form = useForm(
    {
        body: '',
        files: null,
    }
);

function postSelectFile(event) {
    const maxFiles = 2;
    const files = Array.from(event.target.files).slice(0, maxFiles);
    postFiles = [];
    form.files = files;

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
    form.files = postFiles
    console.log(form.files)
}

function submitPost() {
    form.post(route('store.post'), {
        onSuccess: () => {
            closeModal();
            form.body = '';
        },
    });
}

</script>

<template>
    <div class="flex items-center gap-3 mt-4">
        <div class="h-[60px] w-[60px] flex items-center justify-center">
            <Link :href="route('profile',$page.props.auth.user.username)">
                <img
                    :src="user.avatar_url || 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'"
                    class="w-12 h-12 rounded-full object-cover" alt="user-image"
                >
            </Link>
        </div>
        <input
            type="text"
            @click="createPost"
            :readonly="showCreatePost"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 hover:dark:bg dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-full shadow-sm"
            :placeholder="`What's in your mind, ${user.name}?`"
        />
        <Modal :show="showCreatePost" @close="closeModal">
            <div class="bg-gray-700 p-5">
                <div class="relative">
                    <h1 class="pb-1 text-xl text-center font-bold dark:text-white">Create Post</h1>
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


                <textarea
                    rows="10"
                    class="w-full border-none dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:border-none dark:focus:border-none focus:ring-0 dark:focus:ring-0 rounded-md shadow-sm"
                    ref="input"
                    placeholder="What's in your mind, Bhupendra?"
                    v-model="form.body"
                ></textarea>
                <div class="flex justify-end">
                    <InfoButton class="ms-3 relative bg-red-600">
                        Choose File
                        <input type="file" name="file" id="file"
                               class="absolute opacity-0 w-[92px] hover:cursor-pointer" @change="postSelectFile"
                               multiple>
                    </InfoButton>
                    <PrimaryButton class="ms-3" @click="submitPost">Post</PrimaryButton>
                </div>
            </div>
        </Modal>
    </div>

    <hr class="mt-6">

    <div v-for="post in posts" :key="post.id">
        <PostItem :post="post" :user="user"/>
    </div>

</template>

<style scoped>
textarea {
    height: 300px;
    resize: none;
}

textarea:disabled {
    pointer-events: none;
    background-color: transparent;
}
</style>
