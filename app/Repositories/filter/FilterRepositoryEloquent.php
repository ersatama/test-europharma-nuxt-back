<?php


namespace App\Repositories\filter;


use App\Contracts\FilterContract;
use App\Models\Filter;

class FilterRepositoryEloquent implements FilterRepositoryInterface
{
    public function getByMenu(int $menuId):array
    {
        $arr        =   [];
        $filters    =   Filter::where([
            [FilterContract::MENU_ID,$menuId],
            [FilterContract::STATUS,FilterContract::ACTIVE]
        ])->get()->toArray();
        if (sizeof($filters) > 0) {
            foreach ($filters as &$filter) {
                $arr[]  =   [
                    FilterContract::ID      =>  $filter[FilterContract::ID],
                    FilterContract::TITLE   =>  $filter[FilterContract::TITLE],
                    'list'                  =>  $this->filterList($filter[FilterContract::ID])
                ];
            }
        }
        return $arr;
    }

    public function filterList(int $id):array
    {
        $arr    =   [];

        return $arr;
    }
}
