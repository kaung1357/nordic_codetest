import api from './axios'

export const getProducts = () => {
  return api.get('/products')
}

export const createProduct = (data) => {
  return api.post('/products', data)
}

export const getProduct = (id) => {
  return api.get(`/products/${id}`)
}
