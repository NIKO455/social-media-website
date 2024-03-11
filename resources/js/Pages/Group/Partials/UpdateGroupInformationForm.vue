<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import TextArea from "@/Components/TextArea.vue";


defineProps({
    group: Object
});

const {group} = usePage().props


const form = useForm({
    name: group.name,
    description: group.description,
    auto_approval: group.auto_approval,
});


</script>

<template>
    <section>
        <header>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your group all information.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('group.info.update', group.id))" class="mt-6 space-y-6">

            <div class="grid sm:grid-cols-2 gap-6 grid-cols-1 justify-between w-full">

                <div>
                    <InputLabel for="name" value="Name"/>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        placeholder="Enter your group name"
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>
                <div>
                    <InputLabel for="description" value="Description"/>
                    <TextArea
                        id="description"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        autocomplete="description"
                        placeholder="Write about yourself"
                    />
                    <InputError class="mt-2" :message="form.errors.description"/>
                </div>
                <div class="lg:mt-[-90px]">
                    <InputLabel for="auto_approval" value="Select Marital Status"/>
                    <select v-model="form.auto_approval" id="auto_approval"
                            class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                        <option value="0" :selected="form.auto_approval === 0">Manual Approval</option>
                        <option value="1" :selected="form.auto_approval === 1">Auto Approval</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.marital_status"/>
                </div>

            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
