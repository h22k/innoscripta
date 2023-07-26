import A from '../base/A';
import Container from '../base/Container';
import ModalButton from './ModalButton';
import ModalForm from './ModalForm';
import ModalInput from './ModalInput';

export default function LoginForm({ handleRegister, ...rest }){
  return(
    <ModalForm {...rest}>
      <ModalInput label='email' type='email'/>
      <ModalInput label='password' type='password'/>
      <Container className='text-center'>
        <A className='text-xs w-full text-red-700 hover:underline' onClick={handleRegister}>You don't have an account? register here</A>
      </Container>
      <ModalButton>login</ModalButton>
    </ModalForm>
  );
}