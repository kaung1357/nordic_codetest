import api from './axios'

export const checkout = (data) => {
  return api.post('/checkout', data)
}

export const getOrders = () => {
  return api.get('/orders')
}

export const getAdminOrders = () => {
  return api.get('/admin/orders')
}

// Order ကို အတည်ပြုရန်
export const approveOrder = (id) => {
  return api.patch(`/admin/orders/${id}/approve`)
}

// Order ကို ပယ်ဖျက်ရန်
export const rejectOrder = (id) => {
  return api.patch(`/admin/orders/${id}/reject`)
}
