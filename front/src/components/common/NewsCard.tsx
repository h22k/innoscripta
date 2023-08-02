import classNames from 'classnames';
import Container from '../base/Container';
import Figure from '../base/Figure';
import FlexBox from '../base/FlexBox';
import Image from '../base/Image';
import P from '../base/P';
import CardTitle from './CardTitle';
import newsImage from '../../assets/news.jpg'
import Span from '../base/Span';
import { News } from "../../types"

export default function NewsCard({ news, className }: {news: News}){

    const finalClasses = classNames('flex-col sm:flex-row gap-2 col-span-2 mx-6 news-card', className)

    const { title, content, source_name, url, author_name } = news

    const sourceAndAuthor = source_name === author_name ? source_name : `${source_name} | ${author_name}`

    return(
        <FlexBox className={finalClasses}>
            <Figure>
                <Image src={newsImage} alt="news image" className='w-[60rem] sm:h-[8rem] object-cover'/>
            </Figure>
            <Container className="card-body w-2/3">
                <FlexBox className='justify-between header-section sm:flex-row flex-col !items-start sm:items-center gap-1 mb-2'>
                    <CardTitle url={url}>{title}</CardTitle>
                    <Span className='text-xs font-extrabold text-red-600/50 text-right'>{sourceAndAuthor}</Span>
                </FlexBox>
                <P className='line-clamp-4 grow-0 mb-auto'>{content}</P>
            </Container>
        </FlexBox>
    );
}
