import A from '../base/A';
import H2 from '../base/H2';

export default function CardTitle({ children }){
  return(
    <H2 className='font-semibold capitalize text-red-800 hover:font-bold hover:scale-105 origin-left transition-all'>
      <A>
        {children}
      </A>
    </H2>
  );
}
