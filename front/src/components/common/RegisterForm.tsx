import ModalButton from './ModalButton';
import ModalForm from './ModalForm';
import ModalInput from './ModalInput';

export default function RegisterForm({ ...rest }){
  return(
    <ModalForm {...rest}>
      <ModalInput label='name' type='name'/>
      <ModalInput label='email' type='email'/>
      <ModalInput label='password' type='password'/>
      <ModalButton>register</ModalButton>
    </ModalForm>
  );
}