<script setup>
    import { ref, computed } from "vue";
    import { useRouter } from 'vue-router';
    import { useStore } from 'vuex';
    import { request } from '../functions.js';

    const store = useStore();
    const router = useRouter();

    const username = ref('');
    const email = ref('');
    const password = ref('');

    const props = defineProps({
        title: String
    })

    const route = computed(() => {
        return props.title.toLowerCase().replace(' ', '-');
    });

    async function cancelSubmit() {
        await router.push('/');
    }

    async function submitForm() {
        try {
            const csrf = document.head.querySelector('meta[name="csrf-token"]').content;

            let body = {
                email: email.value,
                password: password.value
            };

            if (props.title === 'Sign up') body.name = username.value;  // Append username in reqeust boyd in 'sign up' case

            let response = await request('POST', '/' + route.value, csrf, body);

            if (response.status) {
                await store.dispatch('login');
                await router.push('/');
            } else { alert(response.message); }
        } catch (err) {
            console.error(err);
        }
    }
</script>

<template>
    <div class="flex flex-col items-center">
        <h1>{{ title }}</h1>
        <form @submit.prevent="submitForm" class="flex flex-col items-center p-1">
            <div class="flex flex-col items-center my-4">
                <input v-if="title === 'Sign up'" v-model="username" placeholder="Username" class="input" name="username" type="text" required>
                <input v-model="email" placeholder="Email" class="input" name="email" type="email" required>
                <input v-model="password" placeholder="Password" class="input" name="password" type="password" required>
            </div>


            <div class="size-full flex justify-between">
                <button @click="cancelSubmit" class="btn" type="button">Cancel</button>
                <button class="btn">Submit</button>
            </div>
        </form>
    </div>
</template>