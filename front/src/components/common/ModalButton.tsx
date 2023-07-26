import Button from '../base/Button';
import Container from '../base/Container';

export default function ModalButton({ children }){
  return(
    <Container className='modal-action'>
      <Button className='btn min-h-0 h-auto py-2'>
        {children}
      </Button>
    </Container>
  );
}