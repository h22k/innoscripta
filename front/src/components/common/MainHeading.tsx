import H1 from '../base/H1';

export default function MainHeading({ children }){
    return(
        <H1 className='capitalize w-full px-4 text-3xl font-black text-center flex flex-row before:flex-1 after:flex-1 before:border-b-2 after:border-b-2 before:mr-3 after:ml-3 before:m-auto after:m-auto before:border-gray-300 after:border-gray-300'>
            {children}
        </H1>
    );
}