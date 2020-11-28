<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** Service */
use App\Services\Common\SearchService;
/** Presenter */
use App\Presenters\ProfilePresenter;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    protected $searchService;
    protected $profilePresenter;

    /**
     * SearchController constructor.
     * @param $searchService
     * @param $profilePresenter
     */
    public function __construct(
        SearchService $searchService,
        ProfilePresenter $profilePresenter
    ) {
        $this->searchService = $searchService;
        $this->profilePresenter = $profilePresenter;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function searchProfile(Request $request)
    {
        /** TODO: 検索のロジックを作る */
        $user_type_id = $request->user_type_id;
        $name = $request->name;
        $circle_category_id = $request->circle_category_id;
        $scale_id = $request->scale_id;

        /** TODO: 名前を変えたり、nullを許容したり出来るようにする */
        $users = $this->searchService->searchProfile($user_type_id, $name, $circle_category_id, $scale_id);

        return $this->profilePresenter->setProfileUsers($users);
    }

    /**
     * @return array
     */
    public function getSearchItem()
    {
        $circle_categories = \App\Models\CircleCategory::all();
        $scales = \App\Models\Scale::all();

        $view_date = [
            'circle_categories' => $circle_categories,
            'scales' => $scales
        ];

        return $view_date;
    }
}
