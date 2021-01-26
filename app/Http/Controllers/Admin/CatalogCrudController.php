<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CatalogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Contracts\CatalogContract;
/**
 * Class CatalogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CatalogCrudController extends CrudController
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
        $this->crud->set('reorder.label', CatalogContract::TITLE);
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
        CRUD::setModel(\App\Models\Catalog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/catalog');
        CRUD::setEntityNameStrings('Каталог', 'Каталог');
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
        CRUD::column(CatalogContract::TITLE)->type('text')->label('Заголовок');
        CRUD::column(CatalogContract::URL)->type('text')->label('Ссылка');
        CRUD::column(CatalogContract::ICON)->type('image')->label('Иконка');
        CRUD::column(CatalogContract::IMG)->type('image')->label('Картинка');
        CRUD::column(CatalogContract::STATUS)->type('enum')->label('Статус');
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
        CRUD::setValidation(CatalogRequest::class);

        $this->crud->addFields([
            [
                'name'  => CatalogContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CatalogContract::URL,
                'label' => 'Ссылка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CatalogContract::ICON,
                'label' => 'Иконка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CatalogContract::IMG,
                'label' => 'Картинка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => CatalogContract::STATUS,
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
