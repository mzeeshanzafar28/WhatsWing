<template>
  <AppLayout title="All Messages">
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              All Messages
          </h2>
      </template>

      <div class="bg-white w-full px-5 max-w-full dark:bg-gray-800 rounded-3xl overflow-y-auto no-scrollbar">
          <span class="text-white">Search by:</span>
          <select class="rounded-3xl m-2" v-model="selectedSearchField">
              <option>any</option>
              <option>phone</option>
              <option>type</option>
              <option>status</option>
          </select><br />
          <span class="text-white">Search value:</span>
          <input class="rounded-3xl m-2" placeholder="Search here" type="text" v-model="searchText" />

          <!-- MODAL  -->
          <TransitionRoot as="template" :show="open">
              <Dialog class="relative z-10" @close="open = false">
                  <TransitionChild
                      as="template"
                      enter="ease-out duration-300"
                      enter-from="opacity-0"
                      enter-to="opacity-100"
                      leave="ease-in duration-200"
                      leave-from="opacity-100"
                      leave-to="opacity-0"
                  >
                      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                  </TransitionChild>

                  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                          <TransitionChild
                              as="template"
                              enter="ease-out duration-300"
                              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                              enter-to="opacity-100 translate-y-0 sm:scale-100"
                              leave="ease-in duration-200"
                              leave-from="opacity-100 translate-y-0 sm:scale-100"
                              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                          >
                              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                  <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                      <div class="">
                                          <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                              <IdentificationIcon class="h-6 w-6 text-blue-600" aria-hidden="true" />
                                          </div>
                                          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                              <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                                                  Edit Message
                                              </DialogTitle>
                                              <div class="mt-2">
                                                  <input type="hidden" id="msg-id" v-model="editMessageData.id">
                                                  <div class="mb-4">
                                                      <label class="block text-sm font-medium text-gray-700" for="phone_no">Phone Number</label>
                                                      <input
                                                          type="text"
                                                          id="phone"
                                                          v-model="editMessageData.phone_no"
                                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      />
                                                  </div>
                                                  <div class="mb-4">
                                                      <label class="block text-sm font-medium text-gray-700" for="message">Message</label>
                                                      <textarea
                                                          id="message"
                                                          v-model="editMessageData.message"
                                                          rows="3"
                                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      ></textarea>
                                                  </div>
                                                  <div class="mb-4">
                                                      <label class="block text-sm font-medium text-gray-700" for="type">Type</label>
                                                      <select
                                                          id="type"
                                                          v-model="editMessageData.type"
                                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      >
                                                          <option value="Type1">Type1</option>
                                                          <option value="Type2">Type2</option>
                                                          <option value="Type3">Type3</option>
                                                      </select>
                                                  </div>
                                                  <div class="mb-4">
                                                      <label class="block text-sm font-medium text-gray-700" for="data">Data</label>
                                                      <input
                                                          type="text"
                                                          id="data"
                                                          v-model="editMessageData.data"
                                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      />
                                                  </div>
                                                  <div class="mb-4">
                                                      <label class="block text-sm font-medium text-gray-700" for="priority">Priority</label>
                                                      <select
                                                          type="text"
                                                          id="priority"
                                                          v-model="editMessageData.priority"
                                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      >
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                      <button
                                          type="button"
                                          class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto"
                                          @click="submitEdit"
                                      >
                                          Update
                                      </button>
                                      <button
                                          type="button"
                                          class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                          @click="open = false"
                                      >
                                          Cancel
                                      </button>
                                  </div>
                              </DialogPanel>
                          </TransitionChild>
                      </div>
                  </div>
              </Dialog>
          </TransitionRoot>

          <EasyDataTable class="rounded" :headers="headers" :items="filteredItems">
              <template #item-MessageActions="item">
                  <div class="mt-2">
                      <button
                          type="button"
                          @click="editMessage(item)"
                          class="edit-msg focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                      >
                          Edit
                      </button>
                      <button
                          type="button"
                          @click="deleteMessage(item.id)"
                          class="delete-msg focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                      >
                          Delete
                      </button>
                  </div>
              </template>
          </EasyDataTable>
      </div>
  </AppLayout>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { IdentificationIcon } from '@heroicons/vue/24/outline';

// Reactive state for the modal form
const editMessageData = reactive({
id: '',
phone_no: '',
message: '',
type: '',
data: '',
priority: ''
});

const open = ref(false);

const submitEdit = () => {
axios
  .post('/webapi/updateMessage', editMessageData)
  .then(function(response) {
    console.log('Message updated successfully', response);
    open.value = false; 
    updateMessageInList(response.data.data); 
  })
  .catch(function(error) {
    console.error('There was an error editing the message:', error);
  });
};

const editMessage = (item) => {
axios
  .post('/webapi/getMessageById', { id: item.id })
  .then(function(response) {
    const msg = response.data.data;
    editMessageData.id = msg.id;
    editMessageData.phone_no = msg.phone_no;
    editMessageData.message = msg.message;
    editMessageData.type = msg.type ?? '';
    editMessageData.data = msg.data;
    editMessageData.priority = msg.priority ?? '';

    open.value = true;
  })
  .catch(function(error) {
    console.error('There was an error fetching the message details:', error);
  });
};

const deleteMessage = (id) => {
axios
  .post('/webapi/deleteMessage', { id: id })
  .then(function(response) {
    if (response.status === 200) {
      console.log('Message deleted successfully.');
      removeMessageFromList(id);
    } else {
      console.error('Failed to delete the message. Status: ' + response.status);
    }
  })
  .catch(function(error) {
    console.error('There was an error deleting the message:', error);
  });
};

const updateMessageInList = (updatedMessage) => {
const index = items.findIndex(item => item.id === updatedMessage.id);
if (index !== -1) {
  items[index] = {
    id: updatedMessage.id,
    phone: updatedMessage.phone_no,
    message: updatedMessage.message,
    data: updatedMessage.data,
    type: updatedMessage.type ?? 'none',
    priority: updatedMessage.priority ?? '',
    status: updatedMessage.status,
  };
}
};

const removeMessageFromList = (id) => {
const index = items.findIndex(item => item.id === id);
if (index !== -1) {
  items.splice(index, 1);
}
};

const headers = [
{ text: 'ID', value: 'id', sortable: true },
{ text: 'PHONE', value: 'phone', sortable: true },
{ text: 'MESSAGE', value: 'message' },
{ text: 'TYPE', value: 'type', sortable: true },
{ text: 'DATA', value: 'data' },
{ text: 'PRIORITY', value: 'priority' },
{ text: 'STATUS', value: 'status', sortable: true },
{ text: 'ACTION', value: 'MessageActions' },
];

const items = reactive([]);

onMounted(() => {
axios
  .get('/webapi/getAllMessages')
  .then(response => {
    const messages = response.data.data;
    messages.forEach(message => {
      items.push({
        id: message.id,
        phone: message.phone_no,
        message: message.message,
        data: message.data,
        type: message.type ?? 'none',
        priority: message.priority ?? '',
        status: message.status,
      });
    });
  })
  .catch(error => {
    console.log('Error: ' + error);
  });
});

const selectedSearchField = ref('any');
const searchText = ref('');

const filteredItems = computed(() => {
return items.filter(item => {
  if (selectedSearchField.value === 'any') {
    return Object.values(item).some(property =>
      property &&
      property
        .toString()
        .toLowerCase()
        .includes(searchText.value.toLowerCase())
    );
  }
  return item[selectedSearchField.value]
    ? item[selectedSearchField.value]
        .toLowerCase()
        .includes(searchText.value.toLowerCase())
    : '';
});
});
</script>
