import axios from 'axios'
export default {
    async login(payload) {
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/login', payload)
            const { data, success } = response.data
            return { data, success }
        } catch (error) {
            const { errors } = error.response.data
            return { status: error.status, errorMsg: errors?.email[0] }
        }
    },
}
