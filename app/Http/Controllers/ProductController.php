<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    const LIMIT =   100;

    public function getProductsByMenuAndProduct($slug,$product):array
    {
        $arr    =   [];
        for ($i=0;$i < 100; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function getProductsByMenu($slug):array
    {
        $arr    =   [];
        for ($i=0;$i < 100; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function special():array {
        $arr    =   [];
        for ($i=0;$i < 100; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function getLimit($request): int
    {
        $limit  =   self::LIMIT;
        if ($request->has('limit')) {
            $limit  =   (int)$request->input('limit');
        }
        return $limit;
    }

    public function popular(Request $request):array
    {
        $limit  =   $this->getLimit($request);
        $arr    =   [];
        for ($i=0;$i < $limit; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function getById(int $id):array
    {
        return [
            'id'            =>  $id,
            'product_id'    =>  1,
            'product_slug'  =>  '',
            'img'           =>  '../img/img.jpg',
            'title'         =>  'Подгузники Huggies Elite L (5)',
            'stars'         =>  ['1','1','1','1','0.5'],
            'feedback'      =>  12,
            'price'         =>  1780,
            'limit'         =>  10,
            'details'       =>  [
                'brand'     =>  'Pierre Fabre Dermo-Cosmetics',
                'platform'  =>  'iOS',
                'diagonal'  =>  '4.0',
                'memory'    =>  '32 Гб'
            ],
        ];
    }
}
