<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MenuContract;
use App\Http\Requests\FilterRequest;
use App\Models\Filter;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Contracts\FilterContract;
/**
 * Class FilterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FilterCrudController extends CrudController
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
        $this->crud->set('reorder.label', FilterContract::TITLE);
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
        CRUD::setModel(\App\Models\Filter::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/filter');
        CRUD::setEntityNameStrings('Фильтр', 'Фильтр');
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
        CRUD::column(FilterContract::MENU_ID)->type('select')->label('Меню')
            ->entity('menu')->model('App\Models\Menu')->attribute(MenuContract::TITLE);
        CRUD::column(FilterContract::TITLE)->type('text')->label('Заголовок');
        CRUD::column(FilterContract::STATUS)->type('enum')->label('Статус');
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
        CRUD::setValidation(FilterRequest::class);

        $this->crud->addFields([
            [
                'name'  => FilterContract::MENU_ID,
                'label' => 'Меню',
                'type'  => 'select',
                'entity'    => 'menu',
                'model'     => "App\Models\Menu",
                'attribute' => FilterContract::TITLE,
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => FilterContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => FilterContract::STATUS,
                'label' => 'Статус',
                'type'  => 'enum'
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
