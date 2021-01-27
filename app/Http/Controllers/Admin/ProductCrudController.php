<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MenuContract;
use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Contracts\ProductContract;
/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', ProductContract::TITLE);
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 1);
    }
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('Продукт', 'Продукты');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column(ProductContract::TITLE)->type('text')->label('Название');
        CRUD::column(ProductContract::PRICE)->type('text')->label('Цена');
        CRUD::column(ProductContract::DISCOUNT)->type('text')->label('Скидка');
        CRUD::column(ProductContract::QUANTITY)->type('text')->label('Количество');
        CRUD::column(ProductContract::ECLUB)->type('text')->label('eClub');
        CRUD::column(ProductContract::ECLUB_DISCOUNT)->type('text')->label('eClub скидка');
        CRUD::column(ProductContract::STATUS)->type('enum')->label('Статус');

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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        $this->crud->addFields([
            [
                'name'  => ProductContract::MENU_ID,
                'label' => 'Меню',
                'type'  => 'select',
                'entity'    => 'menu',
                'model'     => "App\Models\Menu",
                'attribute' => MenuContract::TITLE,
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::BARCODE,
                'label' => 'Штрих - код',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::URL,
                'label' => 'Ссылка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::DESCRIPTION,
                'label' => 'Описание',
                'type'  => 'textarea'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::PRICE,
                'label' => 'Цена',
                'type'  => 'number'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::DISCOUNT,
                'label' => 'Цена со скидкой',
                'type'  => 'number'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::LIMIT,
                'label' => 'Лимит на клик',
                'type'  => 'number',
                'value' =>  1
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  =>  ProductContract::TYPE,
                'label' =>  'Тип количества',
                'type'  =>  'text',
                'value' =>  'шт',
                'attributes'    =>  [
                    'placeholder' =>  'штук,пачка или пакет и тд'
                ]
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::QUANTITY,
                'label' => 'Товар в наличии',
                'type'  => 'number'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::ECLUB,
                'label' => 'Цена eClub',
                'type'  => 'number'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::ECLUB_DISCOUNT,
                'label' => 'Цена eClub скидка',
                'type'  => 'number'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => ProductContract::ECLUB_LIMIT,
                'label' => 'eClub лимит',
                'type'  => 'number'
            ]
        ]);




        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
