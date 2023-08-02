import FlexBox from '../base/FlexBox';
import Input from '../base/Input';
import Label from '../base/Label';

export default function ModalInput({ type = 'text', label, callback,  ...rest }){
    return(
        <FlexBox className='justify-between'>
            <Label htmlFor={label} className='mr-2 first-letter:uppercase'>{label}:</Label>
            <Input onChange={({target}) => callback(target.value)} type={type} id={label} placeholder={`Your ${label}`} {...rest} required className="input input-bordered focus:outline-none input-sm w-full max-w-xs" />
        </FlexBox>
    );
}
