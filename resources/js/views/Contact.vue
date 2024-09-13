<template>
    <div>
        <div>
            <div class="flex justify-center background-div align-top h-screen">
                <div class="lg:w-7/12  w-full  mt-20 mb-20 max-w-md h-screen overflow-y-auto ">
                    <div class=" overflow-hidden shadow rounded-lg ">
                        <div class="px-4 py-5 sm:px-6  flex justify-between w-100 bg-blue-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Contacts</h3>
                            <div class="flex gap-3">
                            <button
                                class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1.5 px-5 rounded ml-auto"
                                @click="openModal()"
                            >
                                Add Contact
                            </button>
                            <button
                                class="text-sm bg-green-600 hover:bg-green-700 text-white font-semibold py-1.5 px-5 rounded ml-auto"
                                @click="logout()"
                            >
                                Logout
                            </button>
                            </div>
                        </div>
                        <div class="border-t border-gray-200">
                            <div v-if="users.length<=0" class="flex max-w-full justify-center p-8">
                                <h4>No record found!!!</h4>
                            </div>
                            <div v-else class="w-full overflow-x-auto">
                            <table  class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100 h-16">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        First Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Last Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Email
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Phone
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(user, index) in users" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-light ">
                                            {{ user.first_name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-light">
                                            {{ user.last_name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ user.email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ user.phone }}
                                        </div>
                                    </td>

                                    <td class="flex px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a
                                            href="#"
                                            class="text-indigo-600 hover:text-indigo-900"
                                            @click="openModal(user)"
                                        >Edit</a>
                                        <a
                                            href="#"
                                            class="text-red-600 hover:text-red-900 ml-4"
                                            @click="confirmDelete(user.id)"

                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <upsert-user
                v-if="showEntryDialogue"
                :user-modal="showEntryDialogue"
                :edit-item="editItem"
                @onClose="handleData"
            />
            <div v-if="showDialog" class="fixed z-10 inset-0 overflow-y-auto">
                <div
                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                >
                    <!-- Background overlay -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full h-auto"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Confirm</h3>
                                    <div class="sm:flex sm:flex-wrap sm:justify-between">
                                        <h1>Are you sure to delete this contact ? </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button
                                @click="onRemove"
                                type="button"
                                class="rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                Delete
                            </button>
                            <button
                                @click="cancelDelete"
                                type="button"
                                class="mt-3 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="notAllowed" class="fixed z-10 inset-0 overflow-y-auto">
                <div
                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                >
                    <!-- Background overlay -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full h-auto"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">UnAuthorized</h3>
                                    <div class="sm:flex sm:flex-wrap sm:justify-between">
                                        <h1>You are not allowed to perform this action. </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button
                                @click="hideNotAllowed"
                                type="button"
                                class="mt-3 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                Ok
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import userService from '../service/contactService'
import upsertUser from '../components/upsertUser.vue'

export default {
    name: 'Contact',
    components: {
        upsertUser,
    },

    data() {
        return {
            property: '',
            users: null,
            showEntryDialogue: false,
            showDialog: false,
            editItem: null,
            successMessageVisible: false,
            notAllowed: false,
            successMessage: '',
            recordToDelete: null,
        }
    },
    methods: {

        confirmDelete(recordId) {
            this.recordToDelete = recordId;
            this.showDialog = true;
        },
        cancelDelete() {
            this.showDialog = false;
            this.recordToDelete = null;
        },
        async getUserData() {
            this.users = await userService.getUser()
        },

        openModal(val) {
            this.editItem = val
            this.showEntryDialogue = true
        },
        logout() {
            localStorage.removeItem('token')
            this.$router.push('/')
        },

        handleData(data) {
            this.getUserData()
            this.showEntryDialogue = false
            if (data.message) this.showSuccessMessage(data.message)
        },

        async onRemove() {
            // const {status, message} = await userService.onRemove(this.recordToDelete)
            const {status, message} = await userService.onRemove(this.recordToDelete)
            this.showDialog = false;
            if (message !== "not allowed") {
                this.successMessage = message
                this.successMessageVisible = true
                this.resetSuccessMessage()
            }else{
                this.notAllowed = true;
            }
            this.getUserData()
        },
        hideNotAllowed(){
            this.notAllowed =false;
        },
        showSuccessMessage(message) {
            this.successMessage = message
            this.successMessageVisible = true
            this.resetSuccessMessage()
        },
        resetSuccessMessage() {
            setTimeout(() => {
                this.successMessage = ''
                this.successMessageVisible = false
            }, 2000) // 2 seconds
        },
    },

    created() {
        this.getUserData()
    },
}
</script>

<style>
.flex {
    display: flex;
    align-items: center;
}
.max-w-md {
    max-width: 100%;
}
.background-div {
    background-image: url('/bg.jpg');
    background-size: cover;
    background-position: center;
}
</style>


