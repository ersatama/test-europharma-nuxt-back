<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function all():array
    {
        return [
            [
                'img'   =>  'img/h-1.png',
                'url'   =>  '/story-1',
                'title' =>  'Выгодная покупка',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-2.png',
                'url'   =>  '/story-2',
                'title' =>  'Доставка без уловок',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-3.png',
                'url'   =>  '/story-3',
                'title' =>  'Интерьер на даче',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-4.png',
                'url'   =>  '/story-4',
                'title' =>  'Скидки каждый день',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-5.png',
                'url'   =>  '/story-5',
                'title' =>  'По городу ветерком',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-5.png',
                'url'   =>  '/story-6',
                'title' =>  'По городу ветерком',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
            [
                'img'   =>  'img/h-5.png',
                'url'   =>  '/story-7',
                'title' =>  'По городу ветерком',
                'desc'  =>  'Тысячи товаров со скидкой',
            ],
        ];
    }
}
