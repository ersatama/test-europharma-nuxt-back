<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\MenuContract;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

use App\Models\Catalog;
use App\Contracts\CatalogContract;

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
                $arr    =   [
                    'path'  =>  [
                        $value['title'],
                        $value['url'],
                    ],
                    'list'  =>  $this->subMenu($value['id'])
                ];
                break;
            }
        }
        return $arr;
    }

    public function list(int $id):array
    {
        return Menu::where([[MenuContract::CATEGORY_ID,$id],[MenuContract::STATUS,MenuContract::ACTIVE]])
            ->orderBy(MenuContract::TITLE)->get()->toArray();
    }

    public function subMenu(int $id):array
    {
        $categories =   Category::where(CategoryContract::CATALOG_ID,$id)->get()->toArray();
        foreach ($categories as &$category) {
            $category['list']   =   $this->list($category['id']);
        }
        return $categories;
    }

    public function menu():array
    {
        return Catalog::with('categories')->where(CatalogContract::STATUS,CatalogContract::ACTIVE)->get()->toArray();
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
