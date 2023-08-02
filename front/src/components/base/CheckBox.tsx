import FlexBox from './FlexBox';
import Input from './Input';
import Label from './Label';

export default function Checkbox({ label }){
    return(
        <FlexBox className='gap-2'>
            <Input type='checkbox' id={label} value={label}/>
            <Label htmlFor={label} className='capitalize'>{label}</Label>
        </FlexBox>
    );
}
