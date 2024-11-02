<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Users List
                </h2>
                <TextInput
                    class="border border-gray-300 rounded-md"
                    placeholder="Search for user"
                    v-model="fuzzySearch"
                />
            </div>
        </template>
        <div class="py-12 relative">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <User
                            class="hover:bg-gray-400 hover:cursor-pointer"
                            v-for="user in this.filteredUsers"
                            :user="user"
                        >
                        </User>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import User from "../Components/User.vue";

import { ref } from "vue";
import { usersList } from "../api/user";
import TextInput from "@/Components/TextInput.vue";
const fuzzySearch = ref("");
export default {
    components: {
        User,
        TextInput,
    },
    data() {
        return { users: [], fuzzySearch };
    },
    setup() {
        return { users: response.data };
    },
    mounted() {
        this.handleFetchUsers();
    },
    computed: {
        filteredUsers() {
            return this.users.filter((user) => {
                return (
                    user.first_name
                        .toLowerCase()
                        .includes(this.fuzzySearch.toLowerCase()) ||
                    user.last_name
                        .toLowerCase()
                        .includes(this.fuzzySearch.toLowerCase()) ||
                    user.username
                        .toLowerCase()
                        .includes(this.fuzzySearch.toLowerCase())
                );
            });
        },
    },
    methods: {
        async handleFetchUsers() {
            const response = await usersList();
            this.users = response.data;
        },
    },
};
</script>
