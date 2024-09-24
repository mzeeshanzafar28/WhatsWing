<template>
    <AppLayout title="My Connection">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My Connection
            </h2>
        </template>
        <section class="rounded-3xl overflow-y-auto no-scrollbar w-full bg-white dark:bg-gray-700">
            <div class="p-6">
                <p v-if="loading" class="text-gray-800 dark:text-gray-200">Checking connection...</p>
                <p v-else class="text-gray-800 dark:text-gray-200">{{ message }}</p>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout.vue';

const message = ref('');
const loading = ref(true);
let checkInterval = null;

const checkConnection = async () => {
    try {
        const response = await axios.get('/checkConnection');
        if (response.data.message === 'Your WhatsApp Account is connected.') {
            message.value = response.data.message;
            clearInterval(checkInterval); 
        } else {
            message.value = response.data.message;
        }
    } catch (error) {
        message.value = 'Failed to check connection.';
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    checkConnection();
    checkInterval = setInterval(checkConnection, 10000);
});

onUnmounted(() => {
    clearInterval(checkInterval);
});
</script>
