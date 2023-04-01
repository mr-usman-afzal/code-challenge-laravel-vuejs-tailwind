<template>
  <div>
    <div class="flex justify-center">
      <div class="w-full max-w-md">
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:px-6 bg-gray-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Users:
              <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-5 rounded ml-4"
                @click="openModal()"
              >
                + Add
              </button>
            </h3>
          </div>
          <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
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
                    Created Date
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
                    <div class="text-sm font-medium text-gray-900">
                      {{ user.first_name }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
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
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                      {{ user.created_at }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a
                      href="#"
                      class="text-indigo-600 hover:text-indigo-900"
                      @click="openModal(user)"
                      >Edit</a
                    >
                    <a
                      href="#"
                      class="text-red-600 hover:text-red-900 ml-4"
                      @click="onRemove(user.id)"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <upsert-user
      v-if="showEntryDialogue"
      :user-modal="showEntryDialogue"
      :edit-item="editItem"
      @on-close="handleData"
    />
  </div>
</template>

<script>
import userService from '../service/usersService'
import upsertUser from '../components/upsertUser.vue'
import SuccessErrorPopup from '../components/notifications.vue'

export default {
  name: 'User',
  components: {
    upsertUser,
    SuccessErrorPopup,
  },

  data() {
    return {
      property: '',
      users: null,
      showEntryDialogue: false,
      editItem: null,
    }
  },
  methods: {
    async getUserData() {
      const response = await userService.getUser()
      this.users = response
    },

    openModal() {
      this.editItem = null
      this.showEntryDialogue = true
    },

    handleData(data) {
      const { colse } = data
      this.getUserData()
      this.showEntryDialogue = colse
    },

    async onRemove(id) {
      const response = await userService.onRemove(id)
      this.getUserData()
    },
  },

  created() {
    this.getUserData()
  },
}
</script>

<style>
/* Center the card horizontally */
.flex {
  display: flex;
  align-items: center;
}

/* Set the max width of the card */
.max-w-md {
  max-width: 100%;
}
</style>
