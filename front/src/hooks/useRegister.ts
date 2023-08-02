import { RegisterProp } from "../stores/authStore.ts"
import { useClient } from "./useClient.ts"
import { TokenResponse } from "../types"
import { UriEnum } from "../enums/UriEnum.ts"

export function useRegister(data: RegisterProp) {
    const { response, loading, error } = useClient<TokenResponse>({ url: UriEnum.REGISTER, method: 'POST', data })

    return { response, loading, error }
}
