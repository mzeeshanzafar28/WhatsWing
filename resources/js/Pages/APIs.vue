<template>
    <AppLayout title="APIs">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                APIs
            </h2>
        </template>

        <div class=" dark:bg-gray-700 w-full rounded-3xl overflow-y-auto no-scrollbar bg-white">
            <div class="mx-20 my-10">
                <label for="token" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Generate API Key</label>
            <div class="flex">
            <input type="text" id="token" name="token" placeholder="Your Authentication Token Will Appear Here"
              class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-7/12 p-2.5 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mx-2" @click="generateAPI">Generate</button>
            </div>
        </div>



        <div class="relative overflow-x-auto">
    <table class="w-[60%]  mx-20 bg-white text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-3xl border border-gray-200 dark:border-gray-700">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400 rounded-t-3xl">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Api Key
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="apis-table" class="divide-y divide-gray-200 dark:divide-gray-700">
        </tbody>
    </table>
</div>





            </div>

        

    </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import $ from 'jquery';


onMounted(() => {

    axios.post('/getApis')
        .then(response => {
            response.data.data.forEach(api => {
                var row = "<tr class='bg-white dark:bg-gray-800'>";
                row += "<td scope='col' class='px-6 py-4'>" + api.api_key + "</td>";
                row += "<td scope='col' class='px-6 py-4'><button class='delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900' data-api-id='" + api.id + "'>Delete</button></td>";
                row += "</tr>";

                $('#apis-table').append(row);
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });

});

$(document).on('click', '.delete-btn', function() {
  const apiId = $(this).data('api-id');
  const row = $(this).closest('tr');

    deleteApi(apiId)
    row.fadeOut(1000, function() {
    row.remove();
});

});

const deleteApi = (apiId) => {
    axios.post('/deleteApi', { api_id: apiId })
        .then(response => {
            // console.log('API deleted successfully');
        })
        .catch(error => {
            console.error('Error deleting API:', error);
        });
}

const generateAPI = () => {

      axios.post('/getToken')
        .then(response => {
        document.getElementById('token').value = response.data.access_token;
        var row = "<tr class='bg-white dark:bg-gray-800'>";
                row += "<td scope='col' class='px-6 py-4'>" + response.data.access_token + "</td>";
                row += "<td scope='col' class='px-6 py-4'><button class='delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900' data-api-id='" + response.data.id + "'>Delete</button></td>";
                row += "</tr>";

                $('#apis-table').append(row);
        })
        .catch(error => {
          console.error('Error:', error);
        });
}



</script>
