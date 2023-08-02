import A from '../base/A'
import Container from '../base/Container'
import Form from '../base/Form'
import Input from '../base/Input'
import Label from '../base/Label'
import List from '../base/List'
import ListElement from '../base/ListElement'
import Avatar from './Avatar'
import LoginModal from './LoginModal'
import useAuthStore from "../../stores/authStore.ts"
import useNewsStore from "../../stores/newsStore.ts"
import React from "react"

export default function Navbar() {

    const user = useAuthStore(state => state.user)
    const logout = useAuthStore(state => state.logout)

    const setSearch = useNewsStore(state => state.setSearch)

    const onSearchInputChange = ({ target }: React.FormEvent<HTMLInputElement>) => {
        console.log(target)
        setSearch(target?.value)
    }

    return (
        <Container className='navbar bg-base-100 px-8 border-b gap-6'>
            <Container className='flex-1'>
                <Form className='form-control'>
                    <Input
                        type='text'
                        placeholder='Search'
                        className='input input-bordered h-8 focus:outline-none border-gray-300 w-full md:w-auto'
                        onChange={onSearchInputChange}
                    />
                </Form>
            </Container>
            {user ? (

                <Container className='flex-none gap-2'>
                    <Container className='dropdown dropdown-end'>
                        <Label
                            tabIndex={0}
                            className='btn border-none bg-transparent hover:bg-transparent hover:scale-110 btn-circle avatar'
                        >
                            <Container className='w-10 rounded-full'>
                                <Avatar src='' />
                            </Container>
                        </Label>
                        <List
                            tabIndex={0}
                            className='mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52 text'
                        >
                            <ListElement>
                                <A onClick={logout}>Logout</A>
                            </ListElement>
                        </List>
                    </Container>
                </Container>
            ) : (
                <LoginModal/>
            )}
        </Container>
    )
}
