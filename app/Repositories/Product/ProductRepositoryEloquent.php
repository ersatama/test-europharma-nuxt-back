<?php


namespace App\Repositories\Product;


use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Models\Category;
use App\Models\Product;

class ProductRepositoryEloquent implements ProductRepositoryInterface
{

    public function getProductsByFilter(array $filter):array
    {
        return $filter;
    }

    public function structure(int $skip, int $take):array {
        return [
            'filter'    =>  [
                'price'     =>  [
                    'title' =>  'Цена',
                    'min'   =>  0,
                    'max'   =>  0
                ],
                'options'   =>  [],
                'rating'    =>  [
                    'title' =>  'Рейтинг товара',
                    'list'  =>  []
                ],
                'skip'      =>  $skip,
                'take'      =>  $take
            ],
            'items'     =>  [],
        ];
    }

    public function minPrice(int $menuId):int
    {
        $price  =   0;
        $product    =   Product::where([
            [ProductContract::MENU_ID,$menuId],
            [ProductContract::STATUS,ProductContract::ACTIVE]
        ])->min(ProductContract::PRICE);
        if ($product) {
            return (int) $product;
        }
        return $price;
    }

    public function maxPrice(int $menuId):int
    {
        $price  =   0;
        $product    =   Product::where([
            [ProductContract::MENU_ID,$menuId],
            [ProductContract::STATUS,ProductContract::ACTIVE]
        ])->max(ProductContract::PRICE);
        if ($product) {
            return (int) $product;
        }
        return $price;
    }

}
