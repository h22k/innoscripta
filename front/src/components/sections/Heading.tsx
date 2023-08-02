import H2 from '../base/H2';
import AppSection from '../common/AppSection';
import MainHeading from '../common/MainHeading';

export default function Heading(){
    return(
        <AppSection className='h-36 flex flex-col justify-center items-center bg-neutral-200 rounded-2xl m-6'>
            <MainHeading>
        Discover Todays News
            </MainHeading>
            <H2 className='mt-3 opacity-60 text-sm text-red-700 text-center'>from various trustable news sources with minimum effort</H2>
        </AppSection>
    );
}