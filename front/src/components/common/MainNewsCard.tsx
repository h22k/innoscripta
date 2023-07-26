import NewsCard from './NewsCard';

export default function MainNewsCard({ news }){
  return(
    <NewsCard news={news} className='first:card py-6 flex-row gap-2 sm:first:row-span-2 sm:first:col-span-1 col-span-2 first:shadow-xl main-card'/>
  );
}