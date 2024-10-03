<script setup>
    function handleClick() {
        emit('showModal');
    }

    const emit = defineEmits(['showModal']);
</script>

<template>
    <button @click="handleClick">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="white" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
        </svg>
    </button>
</template>

<style scoped>
    button {
        padding: 0.75rem;
        background-color: #000;
        border-radius: 50%;
        cursor: pointer;
    }
</style>