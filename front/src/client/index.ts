import axios, { AxiosError } from "axios"
import { ApiResponse } from "../types"

const client =  axios.create({
    baseURL: import.meta.env.VITE_BASE_URL as string
})

client.interceptors.response.use((response) => {
    return response
}, (error: AxiosError<ApiResponse<null>>) => {
    alert(error?.response?.data?.errorMessage)
    throw error
})

export default client
