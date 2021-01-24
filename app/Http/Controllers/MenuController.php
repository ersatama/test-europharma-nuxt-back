<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function footer():array
    {
        return [
            'regions'   =>  $this->regions(),
            'menu'      =>  $this->footerMenu()
        ];
    }

    public function regions():array
    {
        return [
            [
                'title' =>  'Алматы'
            ],
            [
                'title' =>  'Нур-Султан',
            ],
            [
                'title' =>  'Шымкент',
            ],
            [
                'title' =>  'Актау',
            ],
            [
                'title' =>  'Атырау',
            ],
            [
                'title' =>  'Караганды',
            ]
        ];
    }

    public function footerMenu():array
    {
        return [
            [
                'url'   =>  '/about',
                'title' =>  'О компании'
            ],
            [
                'url'   =>  '/partner',
                'title' =>  'Стать партнёром'
            ],
            [
                'url'   =>  '/contacts',
                'title' =>  'Контакты'
            ],
            [
                'url'   =>  '/courier',
                'title' =>  'Стать курьером',
            ],
            [
                'url'   =>  '/delivery',
                'title' =>  'Доставка',
            ],
            [
                'url'   =>  '/business',
                'title' =>  'Для бизнеса',
            ],
            [
                'url'   =>  '/terms',
                'title' =>  'Пользовательское соглашение',
            ],
            [
                'url'   =>  '/recycling',
                'title' =>  'Переработка пластика',
            ],
            [
                'url'   =>  '/faq',
                'title' =>  'Вопросы и ответы',
            ],
            [
                'url'   =>  '/feedback',
                'title' =>  'Обратная связь'
            ]
        ];
    }

    public function getNameBySlugAndProduct($slug,$product):array
    {
        $arr    =   [];
        $menu   =   $this->menu();
        foreach ($menu as &$value) {
            if ($value['url'] === ('/'.$slug) || $value['url'] === $slug) {
                $list   =   $this->subMenu($value['id']);
                foreach ($list as &$val) {
                    if ($val['url'] === ('/'.$product) || $val['url'] === $product) {
                        $arr    =   [[$value['title'],$value['url']],[$val['title'],$val['url']]];
                        break;
                    }
                }
                break;
            }
        }
        return $arr;
    }

    public function getNameBySlug($slug):array
    {
        $arr    =   [];
        $menu   =   $this->menu();
        foreach ($menu as &$value) {
            if ($value['url'] === ('/'.$slug) || $value['url'] === $slug) {
                $arr    =   [$value['title'],$value['url']];
                break;
            }
        }
        return $arr;
    }

    public function list():array
    {
        return [
            [
                'title' =>  'Android',
                'url'   =>  '/android'
            ],
            [
                'title' =>  'iPhone',
                'url'   =>  '/iphone'
            ],
            [
                'title' =>  'Беспроводная зарядка',
                'url'   =>  '/wireless_charger'
            ],
            [
                'title' =>  '120 Гц Экран',
                'url'   =>  '/120hz_screen'
            ],
            [
                'title' =>  'Snapdragon 855+',
                'url'   =>  '/snapdragon_855'
            ]
        ];
    }

    public function subMenu(int $id):array
    {
        return [
            [
                'title' =>  'Смартфоны',
                'url'   =>  '/smartphones',
                'list'  =>  $this->list()
            ],
            [
                'title' =>  'Наушники и гарнитуры',
                'url'   =>  '/headphones_and_headsets',
                'list'  =>  $this->list()
            ],
            [
                'title' =>  'Аксессуары',
                'url'   =>  '/accessories',
                'list'  =>  $this->list()
            ],
            [
                'title' =>  'Смарт-часы и браслеты',
                'url'   =>  '/smart_watches_and_bracelets',
                'list'  =>  $this->list()
            ],
            [
                'title' =>  'Аксессуары',
                'url'   =>  '/accessories',
                'list'  =>  $this->list()
            ],
        ];
    }

    public function menu():array
    {
        return [
            [
                'id'    =>  0,
                'icon'  =>  '../img/export.png',
                'logo'  =>  '../img/export.png',
                'title' =>  'Здоровье',
                'url'   =>  '/health',
            ],
            [
                'id'    =>  1,
                'icon'  =>  '../img/smartphone.png',
                'logo'  =>  '../img/smartphone.svg',
                'title' =>  'Смартфоны и гаджеты',
                'url'   =>  '/smartphones_gadgets',
            ],
            [
                'id'    =>  2,
                'icon'  =>  '../img/laptop-computer.png',
                'logo'  =>  '../img/laptop-computer.svg',
                'title' =>  'Ноутбуки и компьютеры',
                'url'   =>  '/laptop_computer',
            ],
            [
                'id'    =>  3,
                'icon'  =>  '../img/game.png',
                'logo'  =>  '../img/game.svg',
                'title' =>  'Игры',
                'url'   =>  '/games',
            ],
            [
                'id'    =>  4,
                'icon'  =>  '../img/relax.png',
                'logo'  =>  '../img/home.svg',
                'title' =>  'Все для дома',
                'url'   =>  '/relax',
            ],
            [
                'id'    =>  5,
                'icon'  =>  '../img/bread.png',
                'logo'  =>  '../img/bread.svg',
                'title' =>  'Продукты',
                'url'   =>  '/products',
            ],
            [
                'id'    =>  6,
                'icon'  =>  '../img/open-book.png',
                'logo'  =>  '../img/open-book.svg',
                'title' =>  'Книги',
                'url'   =>  '/books',
            ],
            [
                'id'    =>  7,
                'icon'  =>  '../img/gym.png',
                'logo'  =>  '../img/gym.svg',
                'title' =>  'Спорт и хобби',
                'url'   =>  '/gym',
            ],
            [
                'id'    =>  8,
                'icon'  =>  '../img/pacifier.png',
                'logo'  =>  '../img/pacifier.png',
                'title' =>  'Детям',
                'url'   =>  '/for_children',
            ],
            [
                'id'    =>  9,
                'icon'  =>  '../img/makeup.png',
                'logo'  =>  '../img/makeup.png',
                'title' =>  'Красота',
                'url'   =>  '/makeup',
            ]
        ];
    }

    public function allMenu():array
    {
        $arr    =   $this->menu();

        foreach ($arr as &$value) {
            $value['submenu']   =   $this->subMenu($value['id']);
        }

        return $arr;
    }
}
