import { useState } from 'react';
import Button from '../base/Button';
import LoginForm from './LoginForm';
import RegisterForm from './RegisterForm';
import Dialog from '../base/dialog';
import Container from '../base/Container';
import Form from '../base/Form';

export default function LoginModal({ handleUser }){

  const [register, setRegister] = useState(false)

  const handleRegister = () => {
    setRegister(true)
  }

  const handleClick = () => {
    window.modal.showModal()
    setRegister(false)
  }

  return(
    <>
      {/* Open the modal using ID.showModal() method */}
      <Button className="btn" onClick={handleClick}>login</Button>
      <Dialog id="modal" className='modal modal-bottom sm:modal-middle'> 
      <Container className="modal-box p-12">
        <Form method="dialog">
          <Button className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</Button>
        </Form>
        {!register ? <LoginForm handleRegister={handleRegister} onSubmit={handleUser}/> : <RegisterForm onSubmit={handleUser}/>}
      </Container>
      </Dialog>
    </>
  );
}