<?php


namespace App\Repositories\Catalog;

use App\Models\Catalog;
use App\Contracts\CatalogContract;

class CatalogRepositoryEloquent implements CatalogRepositoryInterface
{
    public function getBySlug(string $slug):array
    {
        $catalog    =   Catalog::where([
            [CatalogContract::URL,'/'.$slug],
            [CatalogContract::STATUS,CatalogContract::ACTIVE]
        ])->first();
        if ($catalog) {
            return $catalog->toArray();
        }
        return [];
    }
}
