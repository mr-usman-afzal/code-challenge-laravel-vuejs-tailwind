<template>
    <div class="min-h-screen background-div flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-xl">
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <h1 class="font-bold text-center text-2xl mb-5">Login</h1>
                    <form @submit.prevent="login">
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Email</label>
                        <input
                            type="email"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"
                            v-model="email"
                            required
                        />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                        <input
                            type="password"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"
                            v-model="password"
                            required
                        />

                        <button
                            type="submit"
                            class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:outline-none text-white font-semibold rounded-lg px-4 py-2 mt-5 w-full"
                        >
                            Sign In
                        </button>
                    </form>
                    <div
                        v-if="errorMsg"
                        class="mt-4 bg-red-300 p-2 text-sm text-center rounded font-semibold"
                    >
                        {{ errorMsg }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Login from '../service/authService'

export default {
    name: 'login',
    data() {
        return {
            email: '',
            password: '',
            errorMsg: null,
        }
    },
    methods: {
        async login() {
            this.errorMsg = null
            const payload = {
                email: this.email,
                password: this.password,
            }

            const {data, success, errorMsg} = await Login.login(payload)
            console.log(success)

            if (success === true) {
                localStorage.setItem('token', data.token)
                this.$router.push('/contacts')
            } else {
                this.errorMsg = errorMsg
            }
        },
    },
    created() {
        if (localStorage.getItem('token') != null)
            this.$router.push('/contacts')
    }
}
</script>

<style scoped>

.background-div {
    height: 900px;
    width: 100%;
    background-image: url('/bg.jpg');
    background-size: cover;
    background-position: center;
}
</style>
