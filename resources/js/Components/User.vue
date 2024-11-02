<template v-if="user">
    <div class="flex justify-between">
        <div>
            <div>ID :{{ user.id }}</div>

            <div>
                NAME :{{ user.first_name }}
                {{ user.last_name }}
            </div>
            <div>USERNAME :{{ user.username }}</div>
        </div>
        <PrimaryButton
            class="float-right my-auto bg-red-500"
            @click="handleDeleteUser"
            >Delete user</PrimaryButton
        >
    </div>
</template>
<script>
import { deleteUser } from "@/api/user";

import PrimaryButton from "./PrimaryButton.vue";

export default {
    components: {
        PrimaryButton,
    },

    props: {
        user: Object,
    },

    methods: {
        async handleDeleteUser() {
            const response = await deleteUser(this.user.id);
            if (response.status === 200) {
                window.location.reload();
            }
        },
    },
};
</script>
