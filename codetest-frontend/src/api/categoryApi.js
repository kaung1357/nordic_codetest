import api from './axios'

export const createCategory = (data) => {
  return api.post('/categories', data)
}

export const getCategories = () => {
  return api.get('/categories')
}
