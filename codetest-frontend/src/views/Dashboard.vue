<template>
  <div class="min-h-screen bg-gray-50 p-6 font-sans text-gray-900">
    <div class="max-w-7xl mx-auto">
      <div
        class="flex justify-between items-center mb-8 bg-white p-4 rounded-2xl shadow-sm border border-gray-100"
      >
        <h1 class="text-2xl font-black text-blue-600 tracking-tight">MY STORE</h1>

        <div class="flex items-center gap-4">
          <div class="flex items-center gap-3 pr-4 border-r">
            <div
              class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
            </div>
            <div class="hidden sm:block">
              <p class="text-[10px] text-gray-400 font-bold uppercase">Account</p>
              <p class="text-sm font-bold text-gray-700">Logged In</p>
            </div>
          </div>
          <button
            @click="handleLogout"
            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Products Catalog -->
        <div class="lg:col-span-2">
          <h2 class="text-2xl font-extrabold flex items-center text-gray-800 mb-6">
            <span class="bg-blue-600 w-2 h-8 rounded-full mr-3"></span>
            Product Catalog
          </h2>

          <div
            v-if="loading"
            class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl border border-dashed border-gray-300"
          >
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
            <p class="text-gray-500 font-medium animate-pulse">Fetching products...</p>
          </div>

          <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div
              v-for="p in products"
              :key="p.id"
              class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group"
            >
              <div class="mb-5">
                <h3
                  class="font-bold text-lg text-gray-800 group-hover:text-blue-600 transition-colors uppercase italic tracking-wider"
                >
                  {{ p.name }}
                </h3>
                <p class="text-blue-600 font-black text-2xl mt-1">
                  ${{ parseFloat(p.price).toFixed(2) }}
                </p>
              </div>
              <button
                @click="addToCart(p)"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-md active:scale-95"
              >
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <!-- Checkout / Cart Section -->
        <div class="lg:sticky lg:top-6">
          <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-50">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
              <h3 class="text-xl font-bold text-gray-800">Your Cart</h3>
              <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full"
                >{{ totalItems }} Items</span
              >
            </div>

            <div v-if="cart.length === 0" class="py-12 text-center">
              <p class="text-gray-400 italic">Your cart is empty</p>
            </div>

            <div v-else class="space-y-4 mb-6 max-h-[400px] overflow-y-auto pr-2 custom-scroll">
              <div
                v-for="c in cart"
                :key="c.product_id"
                class="bg-gray-50 p-4 rounded-2xl border border-gray-100"
              >
                <div class="flex justify-between items-start mb-3">
                  <span class="font-bold text-gray-700 leading-tight uppercase">{{ c.name }}</span>
                  <span class="font-bold text-gray-900">${{ (c.price * c.qty).toFixed(2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                  <div
                    class="flex items-center bg-white border border-gray-200 rounded-lg overflow-hidden"
                  >
                    <button
                      @click="updateQty(c.product_id, -1)"
                      class="px-2 py-1 hover:bg-gray-50 text-gray-500 border-r"
                    >
                      -
                    </button>
                    <span class="px-3 font-bold text-sm">{{ c.qty }}</span>
                    <button
                      @click="updateQty(c.product_id, 1)"
                      class="px-2 py-1 hover:bg-gray-50 text-gray-500 border-l"
                    >
                      +
                    </button>
                  </div>
                  <button
                    @click="removeFromCart(c.product_id)"
                    class="text-red-400 text-xs font-semibold hover:text-red-600"
                  >
                    Remove
                  </button>
                </div>
              </div>
            </div>

            <div v-if="cart.length > 0" class="border-t border-dashed pt-4 mt-6">
              <div class="flex justify-between items-center mb-6">
                <span class="text-gray-500 font-semibold">Total Amount:</span>
                <span class="text-2xl font-black text-blue-600 font-mono"
                  >${{ totalPrice.toFixed(2) }}</span
                >
              </div>
            </div>

            <transition name="fade">
              <div
                v-if="error"
                class="mb-4 p-4 bg-red-50 text-red-700 text-sm rounded-xl border-l-4 border-red-500 flex items-start gap-2 shadow-sm"
              >
                <span>⚠️</span>
                <span>{{ error }}</span>
              </div>
            </transition>

            <transition name="fade">
              <div
                v-if="success"
                class="mb-4 p-4 bg-green-50 text-green-700 text-sm rounded-xl border-l-4 border-green-500 flex items-start gap-2 shadow-sm"
              >
                <span>✅</span>
                <span>{{ success }}</span>
              </div>
            </transition>

            <button
              @click="placeOrder"
              :disabled="orderLoading || cart.length === 0"
              class="w-full py-4 rounded-2xl font-bold shadow-lg transition-all active:scale-[0.98] disabled:opacity-50 flex justify-center items-center gap-2"
              :class="success ? 'bg-green-600 text-white' : 'bg-gray-900 text-white hover:bg-black'"
            >
              <span v-if="orderLoading" class="animate-pulse">Processing Order...</span>
              <span v-else-if="success">🎉 Order Placed!</span>
              <span v-else>Place Order Now</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../api/axios'

export default {
  data() {
    return {
      products: [],
      cart: [],
      loading: false,
      orderLoading: false,
      error: '',
      success: '',
    }
  },
  computed: {
    totalPrice() {
      return this.cart.reduce((sum, item) => sum + item.price * item.qty, 0)
    },
    totalItems() {
      return this.cart.reduce((sum, item) => sum + item.qty, 0)
    },
  },
  mounted() {
    this.fetchProducts()
  },
  methods: {
    async fetchProducts() {
      this.loading = true
      this.error = ''
      try {
        const res = await api.get('/products')
        this.products = res.data.data
      } catch (err) {
        this.error = 'Failed to load products. Check your connection.'
      } finally {
        this.loading = false
      }
    },
    addToCart(product) {
      this.error = ''
      this.success = ''
      const existing = this.cart.find((i) => i.product_id === product.id)
      if (existing) {
        existing.qty++
      } else {
        this.cart.push({
          product_id: product.id,
          name: product.name,
          price: product.price,
          qty: 1,
        })
      }
    },
    updateQty(id, chg) {
      this.error = ''
      const item = this.cart.find((i) => i.product_id === id)
      if (item) {
        item.qty += chg
        if (item.qty < 1) this.removeFromCart(id)
      }
    },
    removeFromCart(id) {
      this.cart = this.cart.filter((i) => i.product_id !== id)
    },
    async placeOrder() {
      if (this.cart.length === 0) return

      this.orderLoading = true
      this.error = ''
      this.success = ''

      try {
        const orderData = {
          products: this.cart.map((i) => ({ product_id: i.product_id, qty: i.qty })),
        }

        // const orderData = {
        //   products: this.cart.map((i) => ({
        //     product_id: 999999,
        //     qty: i.qty,
        //   })),
        // }

        const res = await api.post('/orders', orderData)

        this.success = 'Order placed successfully! Thank you.'
        this.cart = []
      } catch (err) {
        this.error = err.response?.data?.message || 'Order failed'
      } finally {
        this.orderLoading = false
      }
    },
    handleLogout() {
      if (confirm('Are you sure you want to logout?')) {
        localStorage.removeItem('token')
        delete api.defaults.headers.common['Authorization']
        this.$router.push('/')
      }
    },
  },
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
.custom-scroll::-webkit-scrollbar {
  width: 4px;
}
.custom-scroll::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}
</style>
