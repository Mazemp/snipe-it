<?php

namespace App\Http\Controllers\Api\AccessReview;

use App\Http\Controllers\Controller;
use App\Http\Transformers\AccessReviewCampaignsTransformer;
use App\Models\AccessReviewCampaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    public function index(Request $request): JsonResponse|array
    {
        $this->authorize('admin');

        $allowed_columns = ['id', 'name', 'status', 'launched_at', 'closed_at', 'created_at'];

        $campaigns = AccessReviewCampaign::with('creator')->withCount('items');

        if ($request->filled('search')) {
            $campaigns->where('name', 'LIKE', '%'.$request->input('search').'%');
        }

        if ($request->filled('status')) {
            $campaigns->where('status', $request->input('status'));
        }

        $offset = ($request->input('offset') > $campaigns->count()) ? $campaigns->count() : app('api_offset_value');
        $limit = app('api_limit_value');

        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
        $sort = in_array($request->input('sort'), $allowed_columns) ? $request->input('sort') : 'created_at';

        $campaigns->orderBy($sort, $order);

        $total = $campaigns->count();
        $campaigns = $campaigns->skip($offset)->take($limit)->get();

        return (new AccessReviewCampaignsTransformer)->transformCampaigns($campaigns, $total);
    }
}
