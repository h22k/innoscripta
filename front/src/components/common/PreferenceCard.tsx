import Checkbox from '../base/CheckBox';
import Container from '../base/Container';
import FlexBox from '../base/FlexBox';
import H2 from '../base/H2';

export default function PreferenceCard({ options, title }){
    return(
        <Container className='w-full'>
            <H2 className='text-lg capitalize font-bold mb-2 text-red-800'>{title}</H2>
            <FlexBox className='flex-col ml-3'>
                {options.map((option, index) => (<Checkbox key={index} label={option}/>))}
            </FlexBox>
        </Container>
    );
}