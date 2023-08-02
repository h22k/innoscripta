<?php

namespace App\Http\Controllers\Api\News;

use App\Filters\NewsFilter;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @param  Request  $request
     * @param  NewsFilter  $filter
     * @return JsonResponse
     */
    public function index(Request $request, NewsFilter $filter): JsonResponse
    {
        return ApiResponse::paginate(News::filter($filter));
    }
}
