<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <button @click="isCustomerModalOpen = true">add customer</button>
        <CustomerFormModal
            @close="isCustomerModalOpen = false"
            :show="isCustomerModalOpen"
        />
        <div class="py-12 relative">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div
                            v-if="leftDrawerData"
                            class="absolute mt-12 left-0 top-0 h-full pl-2 bg-white"
                        >
                            <button
                                class="text-red-600 float-right"
                                @click="leftDrawerData = null"
                            >
                                X
                            </button>
                            <div>ID :{{ leftDrawerData.id }}</div>

                            <div>
                                NAME :{{ leftDrawerData.firstName }}
                                {{ leftDrawerData.lastName }}
                            </div>
                            <div>{{ leftDrawerData.email }}</div>
                            <div>{{ leftDrawerData.phone }}</div>
                            <div>{{ leftDrawerData.birthday }}</div>
                        </div>
                        <Customer
                            class="hover:bg-gray-400 hover:cursor-pointer"
                            v-for="customer in user?.customers"
                            :customer="customer"
                            @click="openCustomer"
                        >
                        </Customer>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { useUserStore } from "../stores/userStore";
import Customer from "../Components/Customer.vue";
import Modal from "../Components/Modal.vue";
import PrimaryButton from "../Components/PrimaryButton.vue";
import TextInput from "../Components/TextInput.vue";
import { ref } from "vue";
import CustomerFormModal from "../Components/CustomerFormModal.vue";
const isCustomerModalOpen = ref(false);
export default {
    components: {
        Customer,
        Modal,
        CustomerFormModal,
    },
    data() {
        const user = useUserStore();
        const leftDrawerData = ref(null);
        console.log({ user, customer: user?.customer });
        const openCustomer = (customer) => {
            debugger;
            leftDrawerData.value = customer;
        };
        return {
            user,
            leftDrawerData,
            openCustomer,
            isCustomerModalOpen,
        };
    },
};
</script>
