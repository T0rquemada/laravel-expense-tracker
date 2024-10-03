<script setup>
    import { ref, onMounted, onUnmounted } from 'vue';
    import { useStore } from 'vuex';
    import { request } from '../functions.js';

    const store = useStore();

    let btnsIsShowed = ref(false);
    let isLargeScreen = ref(window.innerWidth >= 1024);

    function showBtns() {
        btnsIsShowed.value = !btnsIsShowed.value;
    }

    function checkScreenWidth() {
        isLargeScreen.value = window.innerWidth >= 1024;
    }

    async function signOut() {
        const csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        let response = await request('POST', '/logout', csrf, {});
        if (response.status) { 
            await store.dispatch('logout');
            window.location.reload();
        }
    }

    onMounted(() => {
        window.addEventListener('resize', checkScreenWidth);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', checkScreenWidth);
    });
</script>

<template>
    <header class="flex  justify-between items-center p-6">
        <div class="header__title text-2xl font-bold select-none">Expense tacker</div>

        <div v-show="btnsIsShowed || isLargeScreen" class="header__btn__container">
            <template v-if="store.state.isAuth">
                <button @click="signOut" class="header__btn btn">Sign out</button>
            </template>
            <template v-else>
                <button class="header__btn btn"><router-link to="/sign-in-view">Sign in</router-link></button>
                <button class="header__btn btn"><router-link to="/sign-up-view">Sign up</router-link></button>
            </template>
        </div>
        <svg @click="showBtns" v-show="!isLargeScreen" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list header__menu__svg cursor-pointer" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
    </header>
</template>

<style>
    .header__btn {
        margin: 0 0.5rem;
        font-size: 1.25rem;
    }
</style>
