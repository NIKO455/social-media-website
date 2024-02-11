<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import TextArea from "@/Components/TextArea.vue";


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    username: user.username,
    permanent_address: user.permanent_address,
    current_address: user.current_address,
    marital_status: user.marital_status,
    college: user.college,
    school: user.school,
    description: user.description
});


</script>

<template>
    <section>
        <header>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile all information.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">

            <div class="grid sm:grid-cols-2 gap-6 grid-cols-1 justify-between w-full">

                <div>
                    <InputLabel for="name" value="Name"/>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>
                <div>
                    <InputLabel for="username" value="Username"/>

                    <TextInput
                        id="username"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.username"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.username"/>
                </div>
                <div>
                    <InputLabel for="email" value="Email"/>

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>
                <div>
                    <InputLabel for="permanent_address" value="Permanent Address"/>
                    <TextInput
                        id="permanent_address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.permanent_address"
                        autocomplete="permanent_address"
                        placeholder="Enter permanent address"
                    />
                    <InputError class="mt-2" :message="form.errors.permanent_address"/>
                </div>
                <div>
                    <InputLabel for="current_address" value="Temporary Address"/>
                    <TextInput
                        id="current_address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.current_address"
                        autocomplete="current_address"
                        placeholder="Enter temporary address"

                    />
                    <InputError class="mt-2" :message="form.errors.current_address"/>
                </div>
                <div>
                    <InputLabel for="college" value="College"/>
                    <TextInput
                        id="college"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.college"
                        autocomplete="college"
                        placeholder="Enter your college name"

                    />
                    <InputError class="mt-2" :message="form.errors.college"/>
                </div>
                <div>
                    <InputLabel for="school" value="School"/>
                    <TextInput
                        id="school"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.school"
                        autocomplete="school"
                        placeholder="Enter your school name"

                    />
                    <InputError class="mt-2" :message="form.errors.school"/>
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
                    <InputLabel for="marital_status" value="Select Marital Status"/>
                    <select v-model="form.marital_status" id="marital_status"
                            class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                        <option value="single" :selected="form.marital_status === 'single'">Single</option>
                        <option value="married" :selected="form.marital_status === 'married'">Married</option>
                        <option value="relationship" :selected="form.marital_status === 'relationship'">Relationship</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.marital_status"/>
                </div>

            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
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
