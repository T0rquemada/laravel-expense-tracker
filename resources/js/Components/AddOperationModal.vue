<script setup>
    import { request } from '../functions.js';
    import { ref, onMounted } from "vue";
    async function submitForm() {
        let body = {
            amount: amount.value,
            date: date.value
        };

        console.log(body);
        emit('close');
    }

    function cancelSubmit() {
        emit('close');
    }

    const amount = ref('');
    const category = ref('');
    const date = ref('');
    const categories = ref([]);

    const exampleCategories = ['Food', 'Transport', 'Rent', 'Entertainment'];

    const props = defineProps({
        isModalVisible: Boolean,
    });

    const emit = defineEmits(['close']);

    onMounted(() => {
        categories.value = exampleCategories;   // Fetch categories from server
    });
</script>

<template>
    <div v-if="isModalVisible" class="flex flex-col items-center bg-[#becbd4] p-4 size-fit border border-black rounded-lg">
        <h1>Create operation</h1>
        <form @submit.prevent="submitForm" class="flex flex-col items-center p-1">
            <div class="flex flex-col items-center my-4">
                <input v-model="amount" type="text" placeholder="Amount" class="input" required>
                
                <!-- Category Select Dropdown -->
            <select v-model="category" class="input" required>
                <option value="" disabled>Select a category</option>
                <option v-for="cat in categories" :key="cat" :value="cat">
                    {{ cat }}
                </option>
            </select>
                
                <input v-model="date" type="date" class="input" required>
            </div>

            <div class="size-full flex justify-between">
                <button @click="cancelSubmit" class="btn" type="button">Cancel</button>
                <button class="btn">Submit</button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
