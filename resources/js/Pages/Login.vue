<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link } from "@inertiajs/vue3";
import { login } from "@/api/user";
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="username" value="username" />

                <TextInput
                    id="username"
                    type="text"
                    name="username"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    name="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('register')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Not a user?
                </Link>
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
            <InputError class="mt-2" :message="form.errors.general" />
        </form>
    </GuestLayout>
</template>
<script>
import { useUserStore } from "../stores/userStore";
export default {
    setup() {
        return { form };
    },
    data() {
        const userStore = useUserStore();

        const form = {
            email: "",
            password: "",
            errors: [],
            status: null,
            processing: false,
        };
        const submit = async (event) => {
            event.preventDefault();
            const formData = new FormData(event.target);

            try {
                const response = await login(formData);
                userStore.setUser(response.data);
                window.location.href = "/dashboard";
            } catch (error) {
                console.error(error);
                this.form.errors.general = error.response.data;
            }
        };
        return {
            submit,
            form,
        };
    },
};
</script>
