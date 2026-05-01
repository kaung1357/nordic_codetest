<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
        <p class="text-gray-500 mt-2">ဆက်လက်ဆောင်ရွက်ရန် အကောင့်ဝင်ပါ</p>
      </div>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email Address</label>
          <input
            v-model="loginData.email"
            type="email"
            required
            placeholder="admin@example.com"
            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input
            v-model="loginData.password"
            type="password"
            required
            placeholder="••••••••"
            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"
          />
        </div>

        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg disabled:bg-blue-300"
        >
          {{ loading ? 'Signing In...' : 'Sign In' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api/axios'

const router = useRouter()
const loading = ref(false)
const loginData = reactive({ email: '', password: '' })

const handleLogin = async () => {
  loading.value = true
  try {
    const res = await api.post('/login', loginData)
    const { token, user } = res.data.data

    localStorage.setItem('token', token)
    localStorage.setItem('user', JSON.stringify(user))

    // Login အောင်မြင်ရင် Product Page (Home) ကို သွားမယ်
    router.push('/dashboard')
  } catch (error) {
    alert(error.response?.data?.message || 'Login Failed!')
  } finally {
    loading.value = false
  }
}
</script>
