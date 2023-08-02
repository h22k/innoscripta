import FlexBox from '../base/FlexBox'
import AppSection from '../common/AppSection'
import FilterBy from '../common/FilterBy'
import PreferenceModal from '../common/PreferenceModal'
import { useEffect } from "react"
import useNewsStore from "../../stores/newsStore.ts"
import { shallow } from "zustand/shallow"
import InfiniteScroll from "react-infinite-scroll-component"
import NewsSection from "./NewsSection.tsx"

export default function Content(){

    const fetchNews = useNewsStore(state => state.fetchNews)
    const { news, isLastPage, loading, search } = useNewsStore((state) => ({
        news: state.news,
        isLastPage: state.isLastPage,
        loading: state.loading,
        search: state.search
    }), shallow)

    useEffect(() => {
        if (!search) {
            fetchNews(true)
        }
    }, [])

    useNewsStore(state => console.log(state))

    return(
        <AppSection>
            <FlexBox className='mb-4 flex-wrap flex-col sm:flex-row !items-start'>
                <FilterBy by='date'/>
                <FilterBy by='category'/>
                <FilterBy by='source'/>
                <PreferenceModal/>
                <span>{news.length} News</span>
            </FlexBox>
            <FlexBox className='w-full gap-6 flex-col lg:flex-row !items-start'>
                {loading
                    ? <span className="loading loading-infinity loading-lg w-100 h-full"></span>
                    : <InfiniteScroll
                        dataLength={news.length}
                        next={() => fetchNews(false)}
                        hasMore={!isLastPage}
                        loader={<p>Loading...</p>}
                        endMessage={<p>No more data to load.</p>}
                    >
                        <NewsSection title='Last news' news={news}></NewsSection>
                    </InfiniteScroll>}
                {/*<NewsSection mini title='Local news' news={news} className='basis-full lg:basis-2/5'/>*/}
            </FlexBox>
        </AppSection>
    );
}
