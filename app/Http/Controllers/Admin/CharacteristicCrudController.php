<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\CharacteristicContract;
use App\Contracts\DefaultValueContract;
use App\Contracts\FilterContract;
use App\Contracts\ProductContract;
use App\Http\Requests\CharacteristicRequest;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\DefaultValue;
use App\Models\Filter;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use GuzzleHttp\Psr7\Request;

/**
 * Class CharacteristicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CharacteristicCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Characteristic::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/characteristic');
        CRUD::setEntityNameStrings('characteristic', 'characteristics');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */

    public function findId():array
    {
        $key    =   'main_form_fields';
        $arr    =   [
            ProductContract::ID      =>  0,
            ProductContract::MENU_ID =>  0
        ];
        if (array_key_exists($key,$_POST)) {
            foreach ($_POST[$key] as &$value) {
                if ($value['name'] === ProductContract::ID) {
                    $arr[ProductContract::ID]        =   $value['value'];
                } elseif ($value['name'] === ProductContract::MENU_ID) {
                    $arr[ProductContract::MENU_ID]   =   $value['value'];
                }
            }
        }
        return $arr;
    }

    protected function setupCreateOperation()
    {
        $menu   =   $this->findId();

        if ($menu[ProductContract::MENU_ID]) {
            $list   =   Filter::where([
                [FilterContract::MENU_ID,$menu[ProductContract::MENU_ID]],
                [FilterContract::STATUS,FilterContract::ACTIVE]
            ])->get()->toArray();
        } else {
            $list   =   Filter::where(FilterContract::STATUS,FilterContract::ACTIVE)
                ->get()->toArray();
        }

        $characteristics    =   Characteristic::where([
            [CharacteristicContract::PRODUCT_ID,$menu[ProductContract::ID]],
            [CharacteristicContract::STATUS,CharacteristicContract::ACTIVE]
        ])->get()->toArray();

        $this->crud->addField([
            'name'  => CharacteristicContract::PRODUCT_ID,
            'type'  => 'hidden',
            'value' => $menu[ProductContract::ID],
        ]);

        foreach ($list as &$item) {
            $defaultValues  =   DefaultValue::select(DefaultValueContract::TITLE)
                ->where([
                [DefaultValueContract::FILTER_ID,$item['id']],
                [DefaultValueContract::STATUS,DefaultValueContract::ACTIVE]
            ])
                ->get()->toArray();
            $arr    =   [];
            foreach ($defaultValues as &$defaultValue) {
                $arr[$defaultValue[DefaultValueContract::TITLE]]    =   $defaultValue[DefaultValueContract::TITLE];
            }
            if ($arr) {
                asort($arr);
                $this->crud->addField([
                    'name'          =>  'category-'.$item['id'],
                    'label'         =>  $item['title'],
                    'type'          =>  'select2_from_array',
                    'options'       =>  $arr,
                    'allows_null'   =>  false,
                ]);
            } else {
                $this->crud->addField([
                    'name'          =>  'category-'.$item['id'],
                    'label'         =>  $item['title'],
                    'type'          =>  'text',
                ]);
            }
        }




        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

     protected function setupInlineCreateOperation()
     {
         $path   =   explode('/',$_SERVER['PATH_INFO']);
         if (end($path) === 'modal') {
             $this->setupCreateOperation();
         } else {
             $productId =   $_POST[CharacteristicContract::PRODUCT_ID];
             Characteristic::where(CharacteristicContract::PRODUCT_ID,$productId)->update([
                 CharacteristicContract::STATUS =>  CharacteristicContract::INACTIVE
             ]);
             foreach ($_POST as $key=>$value) {
                 if (str_starts_with($key, 'category')) {
                    $id =   explode('-',$key);
                    $id =   end($id);
                    $characteristic =   Characteristic::where([
                        [CharacteristicContract::PRODUCT_ID,$productId],
                        [CharacteristicContract::FILTER_ID,$id]
                    ])->first();
                    if ($characteristic) {
                        Characteristic::where([
                            [CharacteristicContract::PRODUCT_ID,$productId],
                            [CharacteristicContract::FILTER_ID,$id]
                        ])->update([
                            CharacteristicContract::TITLE   =>  $value,
                            CharacteristicContract::STATUS  =>  CharacteristicContract::ACTIVE
                        ]);
                    } else {
                        Characteristic::create([
                            CharacteristicContract::PRODUCT_ID  =>  $productId,
                            CharacteristicContract::FILTER_ID   =>  $id,
                            CharacteristicContract::TITLE       =>  $value,
                            CharacteristicContract::STATUS      =>  CharacteristicContract::ACTIVE
                        ]);
                    }
                 }
             }
             /*
              {"success":true,"data":{"character_id":1,"character_value":"12","price":"1200","enabled":"1","updated_at":"2021-01-29T07:17:28.000000Z","created_at":"2021-01-29T07:17:28.000000Z","id":1,"character":{"id":1,"name":"\u0420\u0430\u0437\u043c\u0435\u0440","character_unit":"\u0441\u043c","parent_id":null,"enabled":1,"created_at":"2021-01-29T07:17:13.000000Z","updated_at":"2021-01-29T07:17:13.000000Z"}},"redirect_url":"http:\/\/pizza-express.io\/admin\/product\/create","referrer_url":false}
              */
         }
     }


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
