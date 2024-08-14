<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import 'select2/dist/css/select2.css';
import $ from 'jquery';
import select2 from 'select2';

const phoneRef = ref(null);

select2();


onMounted(() => {
      $(phoneRef.value).select2({
        id: "phone",
        placeholder: "Enter Phone Numbers Here",
        tags: true,
        tokenSeparators: [',', ' '],
        selectOnClose: true,
        createTag: function(params) {
          const term = params.term;
          if (/^[\d+\s\(\)\-,]*$/.test(term)) {
            return {
              id: term,
              text: term
            };
          }
          return null;
        }
      });
    });

  const handleSubmit = (event) => {
  event.preventDefault();

  const phone = $(phoneRef.value).val();
  var priority = document.getElementById('priority').value;
  const message = document.getElementById('message').value;
  const dateElement = document.getElementById('date');
  const date = dateElement ? dateElement.value : '';
  const timeElement = document.getElementById('time');
  const time = timeElement ? timeElement.value : '';
  const dataElement = document.getElementById('data');
  const data = dataElement ? dataElement.value : '';


  if (priority == "Select Priority") priority = 0;

  const dataCollection = {
        phone_no: phone,
        priority: priority,
        scheduled_at:date + " " +  time + ":00",
        message: message,
        data: data,
      };
      
    axios.post("webapi/addMessage", dataCollection)
    .then(response => {
        const removeButtons = document.querySelectorAll('.select2-selection__choice__remove');
        removeButtons.forEach(button => {
        button.click();
           });
        document.getElementById('priority').value = 'Select Priority';
        document.getElementById('message').value = '';
        document.getElementById('date').value = '';
        document.getElementById('time').value = '';
        document.getElementById('data').value = '';
        alert(response.data.message);
    })
    .catch(error => {
        console.error('There was an error!', error);
    });

};


const dropdownItems = ref([
{id:0, name: "0"},
{id:1, name: "1"},
{id:2, name: "2"},
{id:3, name: "3"},
{id:4, name: "4"},
{id:5, name: "5"},
{id:6, name: "6"},
{id:7, name: "7"},
{id:8, name: "8"},
{id:9, name: "9"},
{id:10, name: "10"},
]);



</script>

<template>
  <AppLayout title="Add Message">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Add Message
      </h2>
    </template>
    <section class="bg-white dark:bg-gray-700 w-full rounded-3xl overflow-y-scroll no-scrollbar">

      <div class="bg-gray-200 py-8 px-4 mx-[15%] max-w-full lg:py-14 dark:bg-gray-800 rounded-3xl my-[2%]">

        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add New Message</h2>

        <form @submit="handleSubmit">

          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

            <div class="sm:col-span-2 ">
              <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone No.</label>

              <select ref="phoneRef" class="bg-blue-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Type phone number" required="true" multiple="multiple" name="phone[]" id="phone" >
              </select>

            </div>

            <div>
            <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority (Optional)</label>
            <select id="priority"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-60 p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option selected="">Select Priority</option>
              <option v-for="item in dropdownItems" :value="item.name">{{ item.name }}</option>
            </select>
            <small class="text-yellow-700">ⓘ 0 highest (default), 10 lowest</small>
          </div>

          <div>
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule (Optional)</label>
            <input type="date" id="date" name="date"
              class="bg-gray-50 border sm:w-36 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-60 p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
            
              <input type="time" id="time" name="time"
              class="bg-gray-50 border sm:w-36 border-gray-300 mt-2 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-60 p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>


            <div class="sm:col-span-2">
              <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
              <textarea id="message" rows="8" required="true"
                class="block p-2.5 lg:w-full md:w-full sm:w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Your Message Here"></textarea>
            </div>

            <div class="sm:col-span-2">
              <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data (Optional)</label>
              <textarea id="data" rows="3"
                class="block p-2.5 lg:w-full md:w-full sm:w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter Any Additional Data Here"></textarea>
                <small class="text-yellow-700">ⓘ Use Json Format for Data</small>

            </div>

          </div>
          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 bg-blue-500">
            Submit
          </button>

        </form>
      </div>
    </section>

  </AppLayout>
</template>

<style>
.select2-selection{
  background-color:rgba(249, 250, 251, 0.822) !important;
  color: gray;
  width: 100% !important;
  height: 80px !important
}
.select2-selection__choice__display{
  color:rgb(55 65 81 ) !important;
}
.select2-results__option, .select2-results__message, .select2-dropdown--below{
  display: none !important;
}

   

</style>