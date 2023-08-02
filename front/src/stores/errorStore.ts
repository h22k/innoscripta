import { create } from "zustand"

interface ErrorStore {
    errorMessage: string | null,
    setErrorMessage: (errorMessage: string | null) => void,
}

const useErrorState = create<ErrorStore>()((set) => ({
    errorMessage: null,
    setErrorMessage: (errorMessage) => set(() => ({ errorMessage }))
}))

export default useErrorState
