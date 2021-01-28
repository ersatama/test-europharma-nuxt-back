<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\DefaultValueContract;
use App\Contracts\FilterContract;
use App\Http\Requests\DefaultValueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DefaultValueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DefaultValueCrudController extends CrudController
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
        $this->crud->set('reorder.label', DefaultValueContract::TITLE);
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
        CRUD::setModel(\App\Models\DefaultValue::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/defaultvalue');
        CRUD::setEntityNameStrings('Значения', 'Значении');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column(DefaultValueContract::FILTER_ID)->type('select')->label('Фильтр')
            ->entity('filter')->model('App\Models\Filter')->attribute(FilterContract::TITLE);
        CRUD::column(DefaultValueContract::TITLE)->type('text')->label('Заголовок');
        CRUD::column(DefaultValueContract::STATUS)->type('enum')->label('Статус');

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
        CRUD::setValidation(DefaultValueRequest::class);

        $this->crud->addFields([
            [
                'name'  => DefaultValueContract::FILTER_ID,
                'label' => 'Фильтр',
                'type'  => 'select',
                'entity'    => 'filter',
                'model'     => "App\Models\Filter",
                'attribute' => FilterContract::TITLE,
            ]
        ]);
        $this->crud->addFields([
            [
                'name'  => DefaultValueContract::TITLE,
                'label' => 'Название',
                'type'  => 'text',
            ]
        ]);
        $this->crud->addFields([
            [
                'name'  => DefaultValueContract::STATUS,
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
