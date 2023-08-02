import { create } from "zustand"
import client from "../client"
import { UriEnum } from "../enums/UriEnum.ts"
import { AuthResponse, TokenStructure, User } from "../types"

export type RegisterProp = {
    name: string,
    email: string,
    password: string,
}

export type LoginProp = Omit<RegisterProp, 'name'>

export type UserProps = {
    token: string | null,
    isLogged: boolean,
    user: User | null
}

interface AuthState {
    login: (prop: LoginProp) => Promise<void>;
    logout: () => void;
    token: string | null;
    isLogged: boolean;
    register: (prop: RegisterProp) => Promise<void>;
    user: User | null,
    setAuth: (userProps: UserProps) => void,
    authProcess: (uri: string, prop: LoginProp | RegisterProp) => Promise<void>,
}

const useAuthStore = create<AuthState>()((setState, getState) => ({
    login: async (data: LoginProp) => {
        await getState().authProcess(UriEnum.LOGIN, data)
    },
    logout: () => {
        getState().setAuth({ token: null, user: null, isLogged: false })
    },
    token: null,
    isLogged: false,
    register: async (data) => {
        await getState().authProcess(UriEnum.REGISTER, data)
    },
    user: null,
    setAuth: ({ token, user, isLogged }) => {
        setState(() => ({ token, user, isLogged }))
        console.log(getState())
    },
    authProcess: async (uri, prop) => {
        const response = await client.post<AuthResponse>(uri, prop)
        const responseData = response.data

        if (!responseData.success) {
            return
        }

        const { token, user } = responseData.data as TokenStructure

        getState().setAuth({ token, user, isLogged: true })
    }
}))

export default useAuthStore
