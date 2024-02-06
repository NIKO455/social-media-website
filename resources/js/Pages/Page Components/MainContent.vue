<script setup>
import {ref} from 'vue';
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PostItem from "@/Components/PostItem.vue";

const showCreatePost = ref(false);

const createPost = () => {
    showCreatePost.value = true;
}

const closeModal = () => {
    showCreatePost.value = false;
}
</script>

<template>
    <div class="flex items-center gap-3 mt-4">
        <img
            src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"
            class="w-12 h-12 rounded-full object-cover" alt="user-image"
        >
        <input
            type="text"
            @click="createPost"
            :readonly="showCreatePost"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 hover:dark:bg dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-full shadow-sm"
            placeholder="What's in your mind, Bhupendra?"
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
                        src="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg"
                        alt=""
                        class="h-14 w-14 object-cover rounded-full"
                    >
                    <p class="ml-3 font-bold dark:text-white">Bhupendra Kathayat</p>
                </div>
                <textarea
                    rows="10"
                    class="w-full border-none dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:border-none dark:focus:border-none focus:ring-0 dark:focus:ring-0 rounded-md shadow-sm"
                    ref="input"
                    placeholder="What's in your mind, Bhupendra?"
                ></textarea>
                <div class="flex justify-end">
                    <PrimaryButton class="ms-3">Post</PrimaryButton>
                </div>
            </div>
        </Modal>
    </div>

    <hr class="mt-6">

    <div>
        <PostItem name="Bhupendra Kathayat" post_group="Laravel Developer"
                  avatar="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg" date="1 hour ago"
                  description="a statement that tells you how something or someone looks, sounds, etc. : words that describe something or someone. [count] Reporters called the scene “a disaster area,” and I think that was an accurate description. I applied for the position after reading the job description."/>

        <PostItem name="Bhupendra Kathayat"
                  avatar="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_640.jpg" date="1 hour ago"
                  description="a statement that tells you how something or someone looks, sounds, etc. : words that describe something or someone. [count] Reporters called the scene “a disaster area,” and I think that was an accurate description. I applied for the position after reading the job description."/>
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
