<?php


namespace App\Repositories\Category;

use App\Models\Category;
use App\Contracts\CategoryContract;

class CategoryRepositoryEloquent implements CategoryRepositoryInterface
{
    public function getBySlug(string $slug):array
    {
        $category   =   Category::where([[CategoryContract::URL,'/'.$slug],[CategoryContract::STATUS,CategoryContract::ACTIVE]])->first();
        if ($category) {
            return  $category->toArray();
        }
        return [];
    }
}
