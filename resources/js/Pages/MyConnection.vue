<template>
    <AppLayout title="My Connection">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My Connection
            </h2>
        </template>
        <section class="rounded-3xl overflow-y-auto no-scrollbar w-full bg-white dark:bg-gray-700">
            <div class="">
            </div>
        </section>

        

    </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';


const searchField = ref("player");
const searchValue = ref("Stephen Curry");

const headers = [
    { text: "PLAYER", value: "player" },
    { text: "TEAM", value: "team" },
    { text: "NUMBER", value: "number" },
    { text: "POSITION", value: "position" },
    { text: "HEIGHT", value: "height" },
    { text: "WEIGHT (lbs)", value: "weight", sortable: true },
    { text: "LAST ATTENDED", value: "lastAttended" },
    { text: "COUNTRY", value: "country" },
];

const items = [
    {
        player: "Zeeshan Zafar",
        team: "DWeb",
        number: 28,
        position: "G",
        height: "5-7",
        weight: 185,
        lastAttended: "Multan",
        country: "PK",
    },
    {
        player: "Stephen Curry",
        team: "GSW",
        number: 30,
        position: "G",
        height: "6-2",
        weight: 185,
        lastAttended: "Davidson",
        country: "USA",
    },
    {
        player: "Lebron James",
        team: "LAL",
        number: 6,
        position: "F",
        height: "6-9",
        weight: 250,
        lastAttended: "St. Vincent-St. Mary HS (OH)",
        country: "USA",
    },
    {
        player: "Kevin Durant",
        team: "BKN",
        number: 7,
        position: "F",
        height: "6-10",
        weight: 240,
        lastAttended: "Texas-Austin",
        country: "USA",
    },
    {
        player: "Giannis Antetokounmpo",
        team: "MIL",
        number: 34,
        position: "F",
        height: "6-11",
        weight: 242,
        lastAttended: "Filathlitikos",
        country: "Greece",
    },
];

const selectedSearchField = ref("player");
const searchText = ref("Stephen Curry");

const filteredItems = computed(() => {
    return items.filter(item => {
        return item[selectedSearchField.value].toLowerCase().includes(searchText.value.toLowerCase());
    });
});
</script>
