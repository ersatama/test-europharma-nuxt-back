<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\MenuContract;
use App\Contracts\ProductContract;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

use App\Models\Catalog;
use App\Contracts\CatalogContract;
use App\Repositories\Product\ProductRepositoryEloquent as ProductEloquent;
use App\Repositories\Category\CategoryRepositoryEloquent as CategoryEloquent;
use App\Repositories\Menu\MenuRepositoryEloquent as MenuEloquent;
use App\Repositories\Filter\FilterRepositoryEloquent as FilterEloquent;

class MenuController extends Controller
{
    protected $product;
    protected $category;
    protected $menu;
    protected $filter;
    protected $skip =   0;
    protected $take =   100;

    public function __construct() {
        $this->product  =   new ProductEloquent();
        $this->category =   new CategoryEloquent();
        $this->menu     =   new MenuEloquent();
        $this->filter   =   new FilterEloquent();
    }

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

    public function arr():array
    {
        return [
            'path'      =>  [],
            'menu'    =>  [],
            'list'      =>  [],
        ];
    }

    public function getNameBySlugAndProduct($slug,$product):array
    {

        $arr    =   $this->arr();
        $menu   =   $this->menu();
        foreach ($menu as &$value) {
            if ($value['url'] === ('/'.$slug) || $value['url'] === $slug) {
                $arr['path'][]  =   [
                    $value['title'],
                    $value['url'],
                ];
                $product    =   $this->category->getBySlug($product);
                if ($product) {
                    $arr['path'][]  =   [
                        $product['title'],
                        $product['url']
                    ];
                    $arr['list']    =   $this->menu->getByCategoryId($product[ProductContract::ID]);
                }
            }
        }

        return $arr;
    }

    public function getItems($slug,$product,$item):array {
        $arr    =   $this->arr();
        $menu   =   $this->menu();
        foreach ($menu as &$value) {
            if ($value['url'] === ('/'.$slug) || $value['url'] === $slug) {
                $arr['path'][]  =   [
                    $value['title'],
                    $value['url'],
                ];
                $product    =   $this->category->getBySlug($product);
                if ($product) {
                    $arr['path'][]  =   [
                        $product['title'],
                        $product['url']
                    ];
                    $item   =   $this->menu->getBySlug($item);
                    if ($item) {
                        $arr['path'][]  =   [
                            $item['title'],
                            $item['url']
                        ];
                        $arr['menu']  =   $this->product->structure($this->skip,$this->take);
                        $arr['menu']['filter']['price']['min']  =   $this->product->minPrice($item[MenuContract::ID]);
                        $arr['menu']['filter']['price']['max']  =   $this->product->maxPrice($item[MenuContract::ID]);
                        $arr['menu']['filter']['options']       =   $this->filter->getByMenu($item[ProductContract::ID]);
                    }
                }
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
