import Form from '../base/Form';

export default function ModalForm({ children, ...rest }){
    return(
        <Form className="space-y-4" {...rest}>
            {children}
        </Form>
    );
}