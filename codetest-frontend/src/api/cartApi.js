import api from './axios'

export const getCart = () => {
  return api.get('/cart')
}

export const addToCart = (data) => {
  return api.post('/cart', data)
}

export const updateCart = (productId, data) => {
  return api.put(`/cart/${productId}`, data)
}

// export const removeCart = (productId) => {
//   return api.delete(`/cart/${productId}`)
// }
