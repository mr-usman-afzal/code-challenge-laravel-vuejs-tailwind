import { createRouter, createWebHistory } from 'vue-router'

import Login from '../js/components/login.vue'
import Users from '../js/components/App.vue'

const routes = [
  { path: '/', component: Login },
  { path: '/users', component: Users },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
