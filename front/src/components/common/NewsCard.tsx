import classNames from 'classnames';
import Container from '../base/Container';
import Figure from '../base/Figure';
import FlexBox from '../base/FlexBox';
import Image from '../base/Image';
import P from '../base/P';
import CardTitle from './CardTitle';
import newsImage from '../../assets/news.jpg'
import Span from '../base/Span';

export default function NewsCard({ news, className }){

  const finalClasses = classNames('flex-col sm:flex-row gap-2 col-span-2 mx-6 news-card', className)

  const { url = newsImage, title, content, source } = news
  
  return(
    <FlexBox className={finalClasses}>
      <Figure>
        <Image src={url} alt="news image" className='w-[60rem] sm:max-h-[8rem] lg:max-h-none'/>
      </Figure>
      <Container className="card-body">
        <FlexBox className='justify-between header-section sm:flex-row flex-col !items-start sm:items-center gap-1 mb-2'>
          <CardTitle>{title}</CardTitle>
          <Span className='text-xs font-extrabold text-red-600/50 text-right'>{source}</Span>
        </FlexBox>
        <P className='line-clamp-4 grow-0 mb-auto'>{content}</P>
      </Container>
    </FlexBox>
  );
}