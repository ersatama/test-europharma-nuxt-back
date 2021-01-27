<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Contracts\MenuContract;

class MenuRepositoryEloquent implements MenuRepositoryInterface
{

    public function getByCategoryId(int $categoryId):array
    {
        return Menu::where([
            [MenuContract::CATEGORY_ID,$categoryId],
            [MenuContract::STATUS,MenuContract::ACTIVE]
        ])->get()->toArray();
    }

    public function getByCategoryIdWithFilter(int $categoryId):array
    {
        return Menu::with('filter')
            ->where([
            [MenuContract::CATEGORY_ID,$categoryId],
            [MenuContract::STATUS,MenuContract::ACTIVE]
        ])->get()->toArray();
    }

}
