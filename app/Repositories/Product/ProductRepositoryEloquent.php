<?php


namespace App\Repositories\Product;


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
}
