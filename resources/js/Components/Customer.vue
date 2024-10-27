<template v-if="customer">
    <button @click="$emit('click', this.customer)">
        <div>ID :{{ customer.id }}</div>

        <div>
            NAME :{{ customer.firstName }}
            {{ customer.lastName }}
        </div>
        <div>{{ customer.email }}</div>
        <div>{{ customer.phone }}</div>
        <div>{{ customer.birthday }}</div>
    </button>
    <div class="absolute h-full left-0" v-if="isModalOpen">
        <div class="flex flex-col">
            <div>ID :{{ customer.id }}</div>

            <div>
                NAME :{{ customer.firstName }}
                {{ customer.lastName }}
            </div>
            <div>{{ customer.email }}</div>
            <div>{{ customer.phone }}</div>
            <div>{{ customer.birthday }}</div>
        </div>
    </div>
</template>
<script>
import Modal from "./Modal.vue";

function handleClick() {
    console.log("click");
}
export default {
    components: {
        Modal,
    },
    methods: {
        handleClick,
    },
    props: {
        customer: Object,
    },
    data() {
        return { handleClick };
    },
    methods: {},
    emits: ["click"],
};
</script>
