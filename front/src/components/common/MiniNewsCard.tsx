import NewsCard from './NewsCard';

export default function MiniNewsCard({ news }){

    return(
        <NewsCard news={news} className='mini-card xl:!py-2 sm:py-0'/>
    );
}