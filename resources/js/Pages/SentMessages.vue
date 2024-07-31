<template>
    <AppLayout title="Sent Messages">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Sent Messages
            </h2>
        </template>

        <div class="bg-white w-full  px-5  max-w-full dark:bg-gray-800 rounded-3xl overflow-y-auto no-scrollbar">
            <span class="text-white">Search by:</span>
            <select class="rounded-3xl m-2" v-model="selectedSearchField">
                <option>any</option>
                <option>phone</option>
                <option>type</option>
                <option>status</option>
            </select><br />
            <span class="text-white">Search value:</span>
            <input class="rounded-3xl m-2" placeholder="Search here" type="text" v-model="searchText" />

            <EasyDataTable class="rounded" :headers="headers" :items="filteredItems" />
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';



const headers = [
    { text: "PHONE", value: "phone",sortable: true },
    { text: "MESSAGE", value: "message" },
    { text: "TYPE", value: "type", sortable: true },
    { text: "DATA", value: "data" },
    { text: "STATUS", value: "status", sortable: true },
    { text: "ACTION", value: "action" },
];



const items = reactive([{}]);

onMounted(() => {

axios.get('/webapi/getMessagesByStatus/sent').then((response) => {
    // console.log(response.data.message)
    const messages = response.data.data;
    messages.forEach((message) => {
        items.push({
        "phone": message.phone_no,
        "message": message.message,
        "data": message.data,
        "type": "none",
        "status": message.status,
        "action": "Not Available"
        })
    });

}).
catch((error)=> {
    console.log("error: " + error)
})
});


const selectedSearchField = ref("any");
const searchText = ref("");



const filteredItems = computed(() => {
    return items.filter(item => {
        if (selectedSearchField.value === "any") {
            return Object.values(item).some(property =>
        property && property.toString().toLowerCase().includes(searchText.value.toLowerCase())
      );
        }
        return item[selectedSearchField.value] ?  item[selectedSearchField.value].toLowerCase().includes(searchText.value.toLowerCase()) : '';
    });
});

</script>
