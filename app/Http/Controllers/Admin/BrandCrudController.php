<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Requests\BrandRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BrandCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BrandCrudController extends CrudController
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
        $this->crud->set('reorder.label', BrandContract::TITLE);
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
        CRUD::setModel(\App\Models\Brand::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/brand');
        CRUD::setEntityNameStrings('Бренд', 'Бренд');
        $this->crud->setRequiredFields(BrandRequest::class);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column(BrandContract::TITLE)->type('text')->label('Бренд');
        CRUD::column(BrandContract::ICON)->type('image')->label('Иконка');
        CRUD::column(BrandContract::IMG)->type('image')->label('Картинка');
        CRUD::column(BrandContract::STATUS)->type('enum')->label('Статус');
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
        CRUD::setValidation(BrandRequest::class);

        $this->crud->addFields([
            [
                'name'  => BrandContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text',
                'attributes' => [
                    'required' => true,
                ],
                'wrapper' => [
                    'required' => true
                ],
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => BrandContract::ICON,
                'label' => 'Загрузите иконку',
                'type'  => 'image',
                'crop'    =>  false,
                //'disk'  =>  'uploads',
                'attributes' => [
                    'accept'    =>  'image/jpeg,image/jpg,image/png,image/gif'
                ],
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => BrandContract::IMG,
                'label' => 'Загрузите Картинку',
                'type'  => 'image',
                'crop'    =>  false,
                //'disk'  =>  'uploads',
                'attributes' => [
                    'accept'    =>  'image/jpeg,image/jpg,image/png,image/gif'
                ],
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => BrandContract::STATUS,
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
