<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="firstName" value="first name" />

                <TextInput
                    id="firstName"
                    type="text"
                    name="firstName"
                    class="mt-1 block w-full"
                    v-model="form.firstName"
                    autofocus
                    required
                    autocomplete="firstName"
                />

                <InputError class="mt-2" :message="form.errors.firstName" />
            </div>
            <div>
                <InputLabel for="lastName" value="last name" />

                <TextInput
                    id="lastName"
                    type="text"
                    name="lastName"
                    class="mt-1 block w-full"
                    v-model="form.lastName"
                    required
                    autofocus
                    autocomplete="lastName"
                />

                <InputError class="mt-2" :message="form.errors.lastName" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
        <Modal class="absolute h-full left-0" :show="!!loginCredentials">
            <div class="p-5">
                <h3
                    class="text-xl font-medium text-gray-900 underline-offset-2 underline"
                >
                    Login Credentials
                </h3>

                <div>
                    <p>Username: {{ loginCredentials.username }}</p>
                    <p>Password: {{ loginCredentials.password }}</p>
                </div>

                <NavLink class="mx-auto float-right mb-4" href="/login"
                    >Go to login</NavLink
                >
            </div>
        </Modal>
    </GuestLayout>
</template>
<script>
import { register } from "@/api/user";
import { ref } from "vue";

export default {
    data() {
        let loginCredentials = ref(null);

        const form = {
            first_name: "",
            last_name: "",
            email: "",
            password: "",
            password_confirmation: "",
            errors: {},
        };

        const submit = async (event) => {
            const formData = new FormData(event.target);

            try {
                const response = await register(formData);
                loginCredentials.value = {
                    username: response.data.username,
                    password: response.data.password,
                };
            } catch (error) {
                this.form.errors = error.response.data;
            }
        };
        return { form, submit, loginCredentials };
    },
};
</script>
