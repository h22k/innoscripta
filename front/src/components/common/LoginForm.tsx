import A from '../base/A';
import Container from '../base/Container';
import ModalButton from './ModalButton';
import ModalForm from './ModalForm';
import ModalInput from './ModalInput';
import React, { useState } from "react"
import useAuthStore from "../../stores/authStore.ts"

export default function LoginForm({ handleRegister, buttonRef, ...rest }){

    const [email, setEmail] = useState<string>('')
    const [password, setPassword] = useState<string>('')
    const loginMethod = useAuthStore(state => state.login)
    const user = useAuthStore(state => state.user)

    const submit = async (e: React.FormEvent<HTMLFormElement>): Promise<void> => {
        e.preventDefault()

        if (!(email && password)) {
            return
        }

        await loginMethod({ email, password })

        if (user) {
            buttonRef?.current?.click()
        }
    }

    return(
        <ModalForm {...rest} onSubmit={submit}>
            <ModalInput label='email' callback={setEmail} type='email'/>
            <ModalInput label='password' callback={setPassword} type='password'/>
            <Container className='text-center'>
                <A className='text-xs w-full text-red-700 hover:underline' onClick={handleRegister}>You don't have an account? register here</A>
            </Container>
            <ModalButton>login</ModalButton>
        </ModalForm>
    );
}
