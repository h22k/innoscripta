import classNames from 'classnames';
import NewsHeading from '../common/NewsHeading';
import Container from '../base/Container';
import GridBox from '../base/GridBox';
import MainNewsCard from '../common/MainNewsCard';
import MiniNewsCard from '../common/MiniNewsCard';

export default function NewsSection({ title, news, className = null, mini }){

    const finalClasses = classNames('bg-stone-200 p-4 rounded-xl', className)

    return(
        <Container className={finalClasses}>
            <NewsHeading>{title}</NewsHeading>
            <GridBox className='grid-cols-1 sm:grid-cols-2'>
                {news.map((item,index) => (!mini ? <MainNewsCard news={item} key={index}></MainNewsCard> : <MiniNewsCard news={item} key={index}/>))}
            </GridBox>
        </Container>
    );
}
