import { create } from "zustand"
import { News, PaginationResponse } from "../types"
import client from "../client"
import { UriEnum } from "../enums/UriEnum.ts"

interface Query {
    search: string | null,
    date: string | null,
    category: number | null,
    author: number | null,
    page: number,
}

interface NewsState {
    fetchNews: (isFirstRequest: boolean) => Promise<void>,
    currentPage: number,
    news: Array<News>,
    totalPage: number,
    totalResult: number,
    error: string | null,
    loading: boolean,
    getQuery: () => Query,
    search: string | null,
    date: string | null,
    category: number | null,
    author: number | null,
    setSearch: (search: string | null) => void,
    setDate: (date: string | null) => void,
    setCategory: (category: number | null) => void,
    setAuthor: (author: number | null) => void,
    refreshCurrentPage: () => void,
    isLastPage: boolean,
    setLoading: (loading: boolean) => void,
    refreshEverything: () => void,
}

type NewsResponse = PaginationResponse<Array<News>>

const useNewsStore = create<NewsState>()((setState, getState) => ({
    fetchNews: async (isFirstRequest = true) => {

        const isLastPage = getState().isLastPage

        if (isLastPage && ! isFirstRequest) {
            return
        }

        const params = getState().getQuery()
        try {
            getState().setLoading(true)
            const { data } = await client.get<NewsResponse>(UriEnum.NEWS_INDEX, {
                params
            })

            if (!data.success) {
                return
            }

            const result = data.data

            if (!result) {
                return
            }

            const news = result ? result.data : []
            setState({
                news: isFirstRequest ? [...news] : [...getState().news, ...news],
                totalPage: result.last_page,
                currentPage: result.current_page + 1,
                totalResult: result.total,
                isLastPage: result.last_page === result.current_page
            })

        } catch (e) {
            console.error(e)
        } finally {
            getState().setLoading(false)
        }
    },
    currentPage: 1,
    news: [],
    totalPage: 1,
    totalResult: 1,
    loading: false,
    error: null,
    getQuery: () => {
        return {
            search: getState().search,
            category: getState().category,
            date: getState().date,
            author: getState().author,
            page: getState().currentPage,
        }
    },
    search: null,
    date: null,
    author: null,
    category: null,
    setSearch: (search) => {
        getState().refreshCurrentPage()
        getState().refreshEverything()

        setState(() => ({ search }))

        getState().fetchNews(true)
    },
    setAuthor: (author) => {
        getState().refreshCurrentPage()

        setState(() => ({ author }))
    },
    setCategory: (category) => {
        getState().refreshCurrentPage()

        setState(() => ({ category }))
    },
    setDate: (date) => {
        getState().refreshCurrentPage()

        setState(() => ({ date }))
    },
    refreshCurrentPage: () => {
        setState(() => ({ currentPage: 1 }))
    },
    isLastPage: false,
    setLoading: (loading) => setState(() => ({ loading })),
    refreshEverything: () => {
        getState().refreshCurrentPage()
        setState({
            news: [],
            totalPage: 1,
            totalResult: 1,
            isLastPage: false
        })
    },
}))

export default useNewsStore
