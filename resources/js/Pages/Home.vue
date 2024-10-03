<script setup>
    import Header from '../Components/Header.vue';
    import AddBtn from '../Components/AddBtn.vue';
    import AddOperationModal from '../Components/AddOperationModal.vue';
    import { ref, onMounted } from "vue";
    import { useStore } from 'vuex';

    const store = useStore();

    const isModalVisible = ref(false);

    function showModal() {
        isModalVisible.value = true;
    }

    function closeModal() {
        isModalVisible.value = false;
    }

    onMounted(async () => {
        await store.dispatch('tryAutoLogin');
    });
</script>

<template>
    <Header />

    <div id="add_operation_modal__container">
        <AddOperationModal 
            :isModalVisible="isModalVisible" 
            @close="closeModal" 
        />
    </div>
    

    <div v-if="store.state.isAuth" id="add_operation_btn__container">
        <AddBtn 
            @showModal="showModal"
        />
    </div>
    
</template>

<style>
    #add_operation_modal__container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #add_operation_btn__container {
        position: absolute;
        right: 2rem;
        bottom: 2rem;
    }
</style>