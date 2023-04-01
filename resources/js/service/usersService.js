import axios from 'axios'
export default {
  async getUser() {
    try {
      const { data } = await axios.get('http://0.0.0.0/api/contacts/')
      return data.data
    } catch (error) {
      console.log(error)
    }
  },

  async addUser(payload) {
    try {
      const response = await axios.post('http://0.0.0.0/api/contacts', payload)

      return response.status
    } catch (error) {
      console.log(error)
    }
  },

  async editUser(id, payload) {
    try {
      const response = await axios.put(`http://0.0.0.0/api/contacts/${id}`, payload)

      return response.status
    } catch (error) {
      console.log(error)
    }
  },

  async onRemove(id) {
    try {
      const token = localStorage.getItem('token')

      const config = {
        headers: { Authorization: `Bearer ${token}` },
      }
      const response = await axios.delete(`http://0.0.0.0/api/contacts/${id}`, config)

      return response.status
    } catch (error) {
      return error.response.status
    }
  },
}
