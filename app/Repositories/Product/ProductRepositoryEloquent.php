<?php


namespace App\Repositories\Product;


use App\Contracts\CategoryContract;
use App\Contracts\CharacteristicContract;
use App\Contracts\FilterContract;
use App\Contracts\ProductContract;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;

class ProductRepositoryEloquent implements ProductRepositoryInterface
{

    public function getBySlug(string $slug):array
    {
        $product    =   Product::with('characteristics','brand')->where([
            [ProductContract::URL,'/'.$slug],
            [ProductContract::STATUS,ProductContract::ACTIVE]
        ])->first();
        if ($product) {
            $product    =   $product->toArray();
            $this->productImage($product);
            $this->productCharacteristic($product);
            return $product;
        }
        return [];
    }

    public function getFilterById(int $filterId):array
    {
        $filter =   Filter::where([
            [FilterContract::ID,$filterId],
            [FilterContract::STATUS,FilterContract::ACTIVE]
        ])->first();
        if ($filter) {
            return $filter->toArray();
        }
        return [];
    }

    public function productCharacteristic(array &$product):void
    {
        if (array_key_exists('characteristics',$product) && sizeof($product['characteristics']) > 0) {
            foreach ($product['characteristics'] as &$characteristic) {
                $characteristic[CharacteristicContract::FILTER_ID]  =   $this->getFilterById($characteristic[CharacteristicContract::FILTER_ID]);
            }
        }
    }

    public function special(int $skip,int $take):array
    {
        $products   =   Product::where(ProductContract::STATUS,ProductContract::ACTIVE)
            ->skip($skip)->take($take)->get()->toArray();
        $this->productsImage($products);
        return array_merge($products,$products);
    }

    public function popular(int $skip,int $take):array
    {
        $products   =   Product::where(ProductContract::STATUS,ProductContract::ACTIVE)
            ->skip($skip)->take($take)->get()->toArray();
        $this->productsImage($products);
        return array_merge($products,$products);
    }

    public function img(int $productId):array
    {
        return [
            [
                'img'   =>  'http://127.0.0.1:8000/img/img-1.png'
            ],
            [
                'img'   =>  'http://127.0.0.1:8000/img/img-2.png'
            ],
            [
                'img'   =>  'http://127.0.0.1:8000/img/img-3.jpeg'
            ],
            [
                'img'   =>  'http://127.0.0.1:8000/img/img.png'
            ],
            [
                'img'   =>  'http://127.0.0.1:8000/img/img.png'
            ]
        ];
    }

    public function productImage(array &$product):void
    {
        $product['img'] =   $this->img($product[ProductContract::ID]);
    }

    public function productsImage(array &$products):void
    {
        foreach ($products as &$product) {
            $product['img'] =   $this->img($product[ProductContract::ID]);
        }

    }

    public function getByMenuId(int $menuId, int $skip, int $take): array
    {
        $products   =   Product::where([
            [ProductContract::MENU_ID,$menuId],
            [ProductContract::STATUS,ProductContract::ACTIVE]
        ])->skip($skip)->take($take)->get()->toArray();
        $this->productsImage($products);
        return array_merge($products,$products,$products);
    }

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
