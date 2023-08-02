import { AxiosError, Method } from "axios"
import { User } from "./model.ts"

export type ClientConfig = {
    url: string,
    method: Method,
    data?: object,
    params?: object,
}

export type ApiResponse<T> = {
    data: T | null,
    errors: object | null,
    errorMessage: string | null,
    success: boolean,
}

export type RequestResponse<T> = {
    response: ApiResponse<T> | null,
    loading: boolean,
    error: AxiosError | null,
}

export type TokenStructure = {
    user: User,
    token: string,
    type: string,
    expires_in: number,
}

export type PaginationStructure<T> = {
    data: T,
    current_page: number,
    first_page_url: string,
    from: number,
    last_page: number,
    last_page_url: string,
    next_page_url: string | null,
    per_page: number,
    prev_page_url: string | null,
    to: number,
    total: number,
}

export type AuthResponse = ApiResponse<TokenStructure>
export type PaginationResponse<T> = ApiResponse<PaginationStructure<T>>
