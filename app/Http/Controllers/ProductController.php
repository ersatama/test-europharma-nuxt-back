<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\FilterContract;
use App\Contracts\MenuContract;
use Illuminate\Http\Request;
use App\Repositories\Catalog\CatalogRepositoryEloquent as Catalog;
use App\Repositories\Category\CategoryRepositoryEloquent as Category;
use App\Repositories\Menu\MenuRepositoryEloquent as Menu;
use App\Repositories\Product\ProductRepositoryEloquent as Product;

class ProductController extends Controller
{

    const LIMIT =   100;
    protected $catalog;
    protected $category;
    protected $menu;
    protected $product;

    protected $skip =   0;
    protected $take =   100;

    public function __construct() {
        $this->catalog  =   new Catalog();
        $this->category =   new Category();
        $this->menu     =   new Menu();
        $this->product  =   new Product();
    }

    public function getProductsByCategory($category):array
    {

        $arr        =   $this->product->structure($this->skip,$this->take);
        $category   =   $this->category->getBySlug($category);

        if ($category) {
            $menu   =   $this->menu->getByCategoryIdWithFilter($category[CategoryContract::ID]);
            foreach ($menu as &$item) {
                foreach ($item['filter'] as &$filter) {
                    $arr['filter']['options'][$filter['id']]   =   $filter;
                }
            }
        }

        return $this->product->getProductsByFilter($arr);
    }

    public function filterCreate(Request $request) {
        if ($request->has('main_form_fields')) {
            $menu   =   $request->input('main_form_fields')[0]['value'];
            return \App\Models\Filter::where(FilterContract::MENU_ID,$menu)
                ->get()->toArray();
        }
        return [];
    }

    public function filterCreateSave() {

    }

    public function getProductsByMenuAndProduct($slug,$product):array
    {
        $arr    =   [];
        for ($i = 0;$i < 100; $i++) {
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
