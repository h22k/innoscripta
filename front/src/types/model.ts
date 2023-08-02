export type User = {

}
export type News = {
    id: number,
    author_id: number,
    category_id: number | null,
    title: string,
    description: string,
    url: string,
    published_at: string,
    content: string,
    created_at: string,
    updated_at: string,
    author_name: string,
    source_name: string,
}
