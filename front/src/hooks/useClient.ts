import { useEffect, useState } from "react"
import { AxiosError, AxiosResponse } from "axios"
import client from "../client"
import { ApiResponse, ClientConfig, RequestResponse } from "../types"

export function useClient<T>(clientConfig: ClientConfig): RequestResponse<T> {
    const [response, setResponse] = useState<ApiResponse<T> | null>(null)
    const [loading, setLoading] = useState<boolean>(false)
    const [error, setError] = useState<AxiosError | null>(null)

    useEffect(() => {
        const fetchData = async () => {
            try {
                setLoading(true)

                const response: AxiosResponse<ApiResponse<T>> = await client.request(clientConfig)
                setResponse(response.data)
                setError(null)
            } finally {
                setLoading(false)
            }
        }

        fetchData().catch((err: AxiosError) => {
            setResponse(err?.response?.data as ApiResponse<T>)
            setError(err)
        })
    }, [clientConfig.url])

    return { response, loading, error }
}
