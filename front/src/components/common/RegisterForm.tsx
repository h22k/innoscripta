import ModalButton from './ModalButton'
import ModalForm from './ModalForm'
import ModalInput from './ModalInput'
import React, { useState } from "react"
import useAuthStore from "../../stores/authStore.ts"

export default function RegisterForm({ buttonRef, ...rest }: {buttonRef: React.MutableRefObject<HTMLButtonElement>, rest: any}){
    const [name, setName] = useState<string>('')
    const [email, setEmail] = useState<string>('')
    const [password, setPassword] = useState<string>('')
    const registerMethod = useAuthStore(state => state.register)
    const user = useAuthStore(state => state.user)

    const submit = async (e: React.FormEvent<HTMLFormElement>): Promise<void> => {
        if (!(name && email && password)) {
            return
        }

        await registerMethod({ name, email, password })

        if (user) {
            buttonRef.current.click()
        }

        e.preventDefault()
    }
    return(
        <ModalForm {...rest} onSubmit={submit}>
            <ModalInput label='name' callback={setName} type='name'/>
            <ModalInput label='email' callback={setEmail} type='email'/>
            <ModalInput label='password' callback={setPassword} type='password'/>
            <ModalButton>register</ModalButton>
        </ModalForm>
    );
}
