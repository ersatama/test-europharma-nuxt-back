<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\MenuContract;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MenuCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MenuCrudController extends CrudController
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
        $this->crud->set('reorder.label', MenuContract::TITLE);
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
        CRUD::setModel(\App\Models\Menu::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/menu');
        CRUD::setEntityNameStrings('Меню', 'Меню');
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
        CRUD::column(MenuContract::CATEGORY_ID)->type('select')->label('Категория')
            ->entity('category')->model('App\Models\Category')->attribute(MenuContract::TITLE);
        CRUD::column(MenuContract::TITLE)->type('text')->label('Заголовок');
        CRUD::column(MenuContract::URL)->type('text')->label('Ссылка');
        CRUD::column(MenuContract::ICON)->type('image')->label('Иконка');
        CRUD::column(MenuContract::IMG)->type('image')->label('Картинка');
        CRUD::column(MenuContract::STATUS)->type('enum')->label('Статус');
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
        CRUD::setValidation(MenuRequest::class);

        $this->crud->addFields([
            [
                'name'  => MenuContract::CATEGORY_ID,
                'label' => 'Категория',
                'type'  => 'select',
                'entity'    => 'category',
                'model'     => "App\Models\Category",
                'attribute' => CategoryContract::TITLE,
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => MenuContract::TITLE,
                'label' => 'Заголовок',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => MenuContract::URL,
                'label' => 'Ссылка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => MenuContract::ICON,
                'label' => 'Иконка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => MenuContract::IMG,
                'label' => 'Картинка',
                'type'  => 'text'
            ]
        ]);

        $this->crud->addFields([
            [
                'name'  => MenuContract::STATUS,
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
