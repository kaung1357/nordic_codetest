import api from './axios'

export const placeOrder = (data) => {
  return api.post('/checkout', data, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
}
