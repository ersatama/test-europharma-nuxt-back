<?php


namespace App\Repositories\Category;

use App\Models\Category;
use App\Contracts\CategoryContract;

class CategoryRepositoryEloquent implements CategoryRepositoryInterface
{

    public function getBySlug(string $slug):array
    {
        $categories =   Category::where([
            [CategoryContract::URL,'/'.$slug],
            [CategoryContract::STATUS,CategoryContract::ACTIVE]
        ])->first();
        if ($categories) {
            return  $categories->toArray();
        }
        return [];
    }
}
