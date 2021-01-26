<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CatalogContract;
use App\Contracts\CategoryContract;
use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
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
        $this->crud->set('reorder.label', CategoryContract::TITLE);
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
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('Категорию', 'Категорий');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        CRUD::column(CategoryContract::CATALOG_ID)->type('select')->label('Каталог')
            ->entity('catalog')->model('App\Models\Catalog')->attribute(CatalogContract::TITLE);
        CRUD::column(CategoryContract::TITLE)->type('text')->label('Заголовок');
        CRUD::column(CategoryContract::URL)->type('text')->label('Ссылка');
        CRUD::column(CategoryContract::ICON)->type('image')->label('Иконка');
        CRUD::column(CategoryContract::IMG)->type('image')->label('Картинка');
        CRUD::column(CategoryContract::STATUS)->type('enum')->label('Статус');
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
        CRUD::setValidation(CategoryRequest::class);
        $this->crud->addFields([
            [
                'name'  => CategoryContract::CATALOG_ID,
                'label' => 'Каталог',
                'type'  => 'select',
                'entity'    => 'catalog',
                'model'     => "App\Models\Catalog",
                'attribute' => CatalogContract::TITLE,
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CategoryContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CategoryContract::URL,
                'label' => 'Ссылка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CategoryContract::ICON,
                'label' => 'Иконка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CategoryContract::IMG,
                'label' => 'Картинка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CategoryContract::STATUS,
                'label' => 'Статус',
                'type'  => 'enum'
            ]
        ]);
        //CRUD::setFromDb(); // fields

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
