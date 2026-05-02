<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
      <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold text-blue-600 tracking-tight">LOGIN</h2>
        <div class="h-1 w-12 bg-blue-600 mx-auto mt-2 rounded-full"></div>
      </div>

      <div
        v-if="errorMessage"
        class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg animate-pulse"
      >
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
              clip-rule="evenodd"
            />
          </svg>
          <span class="font-semibold">{{ errorMessage }}</span>
        </div>
      </div>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div>
          <label class="block text-sm font-semibold text-gray-600 ml-1">Email Address</label>
          <input
            v-model="loginData.email"
            type="email"
            required
            placeholder="admin@example.com"
            @input="errorMessage = ''"
            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200"
            :class="{ 'border-red-400 bg-red-50': errorMessage }"
          />
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-600 ml-1">Password</label>
          <input
            v-model="loginData.password"
            type="password"
            required
            placeholder="••••••••"
            @input="errorMessage = ''"
            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200"
            :class="{ 'border-red-400 bg-red-50': errorMessage }"
          />
        </div>

        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg shadow-blue-100 disabled:bg-blue-300 disabled:cursor-not-allowed flex justify-center items-center"
        >
          <span v-if="loading" class="flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              ></circle>
              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
            Signing In...
          </span>
          <span v-else>Sign In</span>
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
const errorMessage = ref('')

const loginData = reactive({
  email: 'admin@gmail.com',
  password: '12345678',
})

const handleLogin = async () => {
  loading.value = true
  errorMessage.value = ''

  try {
    const res = await api.post('/login', loginData)

    const { token, user } = res.data.data

    localStorage.setItem('token', token)
    localStorage.setItem('user', JSON.stringify(user))

    router.push('/dashboard')
  } catch (error) {
    errorMessage.value =
      error.response?.data?.message || 'Incorrect email or password. Please try again.'
    console.error('Login Error:', error)
  } finally {
    loading.value = false
  }
}
</script>
