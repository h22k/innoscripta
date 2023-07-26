import A from '../base/A';
import H2 from '../base/H2';
import Span from '../base/Span';

export default function NewsHeading({ children }){
  return(
    <H2 className='text-xl font-semibold before:h-px before:hover:w-full before:w-0 before:transition-all before:duration-1000 before:bg-red-700 before:block before:-bottom-px before:absolute relative mb-6'>
      <A>
        <Span className='relative first-letter:uppercase before:w-full before:h-0.5 before:bg-red-700 before:-bottom-[2.5px] before:absolute before:inline-block'>
          {children}
        </Span>
      </A>
    </H2>
  );
}