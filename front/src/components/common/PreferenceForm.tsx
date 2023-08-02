import Button from '../base/Button';
import Container from '../base/Container';
import Form from '../base/Form';
import PreferenceCard from './PreferenceCard';

export default function PreferenceForm({  }){

    const sourceOptions = ['BBC', 'new york times', 'abc news']
    const authorOptions = ['hako', 'meliko', 'nazo', 'zeyno']

    const handleSubmit = () => {
    
    }

    return(
        <Form method="dialog" className="modal-box" onSubmit={handleSubmit}>
            <Container className='space-y-6'>
                <PreferenceCard options={sourceOptions} title='source preference'/>
                <PreferenceCard options={authorOptions} title='author preference'/>
            </Container>
            <Container className="modal-action">
                <Button className="btn">Save</Button>
            </Container>
        </Form>
    );
}