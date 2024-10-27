<template>
    <Modal :show="show">
        <div
            @click="$emit('close')"
            class="hover:cursor-pointer text-red-400 float-right m-3"
        >
            X
        </div>
        <form @submit.prevent="submit" class="m-5">
            <div>
                <InputLabel for="first_name" value="first name" />

                <TextInput
                    id="first_name"
                    type="text"
                    name="first_name"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors?.first_name" />
            </div>
            <div>
                <InputLabel for="last_name" value="last name" />

                <TextInput
                    id="last_name"
                    type="text"
                    name="last_name"
                    class="mt-1 block w-full"
                    v-model="form.last_name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors?.last_name" />
            </div>
            <div class="mt-4">
                <InputLabel for="phone" value="phone number" />

                <TextInput
                    id="phone"
                    type="text"
                    name="phone"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                />

                <InputError class="mt-2" :message="form.errors?.phone" />
            </div>
            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    name="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                />

                <InputError class="mt-2" :message="form.errors?.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="birthday" value="Birthday" />

                <TextInput
                    id="birthday"
                    type="date"
                    name="birthday"
                    class="mt-1 block w-full"
                    v-model="form.birthday"
                    required
                />

                <InputError class="mt-2" :message="form.errors?.birthday" />
            </div>
            <PrimaryButton type="submit">Add Customer</PrimaryButton>
        </form>
    </Modal>
</template>
<script>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import { addCustomer } from "@/api/customer";
import { useUserStore } from "@/stores/userStore";
export default {
    components: {
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Modal,
    },
    data() {
        const user = useUserStore();
        const submit = async (event) => {
            const formData = new FormData(event.target);
            formData.append("user_id", user.id);

            try {
                const response = await addCustomer(formData);
                await user.refreshUserData();
                this.$emit("close");
            } catch (error) {
                this.form.errors = error.response?.data;
            }
        };

        return {
            form: {
                name: "",
                first_name: "",
                last_name: "",
                user_identifier: "",
                errors: {},
            },
            submit,
        };
    },
    props: {
        show: {
            type: Boolean,
            default: false,
        },
    },
    emits: ["close"],
};
</script>
