<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function special():array {
        $arr    =   [];
        for ($i=0;$i < 100; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function popular():array
    {
        $arr    =   [];
        for ($i=0;$i < 100; $i++) {
            $arr[]  =   $this->getById($i);
        }
        return $arr;
    }

    public function getById(int $id):array
    {
        return [
            'id'        =>  $id,
            'img'       =>  '../img/img.jpg',
            'title'     =>  'Подгузники Huggies Elite L (5)',
            'stars'     =>  ['1','1','1','1','0.5'],
            'feedback'  =>  12,
            'price'     =>  1780,
            'limit'     =>  10
        ];
    }
}
