<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompetitionsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CompetitionsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompetitionsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Competitions::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/competitions');
        CRUD::setEntityNameStrings('competitions', 'competitions');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->type('my_custom_column');

        CRUD::column('name');
        CRUD::column('prize_pool')->type('number');
        CRUD::column('event_location');
        CRUD::column('event_date');
        /**
         * prefix, suffix
         * type: image,
         * ->wrapper([
         *  href = function($crud,$,$entry){
         * return backpack_url('/cat'.$entry.'/show')
         * }
         * ])
         * 
         * 'class' => function ($crud, $column, $entry){
         *  returnr match($status){
         *  'DONE'=>'badge bg-success'
         * 'WORK' =>'badge bg-secondary'
         * }
         * }
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }
    public function showDetailsRow($id){
        return "HI";
    }

    protected function setupShowOperation(){
        
        CRUD::column('name'); // without tab - goes on top
        CRUD::column('prize_pool')->type('number')->tab('1');
        CRUD::column('event_location')->tab('1');
        CRUD::column('event_date')->tab('2');
    }
    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CompetitionsRequest::class);
        CRUD::field('name');
        CRUD::field('prize_pool');
        CRUD::field('event_date');
        CRUD::field('event_location');
        CRUD::field('gender');
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
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
        CRUD::setValidation(CompetitionsRequest::class);
        CRUD::field('name');
        CRUD::field('prize_pool');
        CRUD::field('event_date');
        CRUD::field('event_location');
        CRUD::field('gender');
    }
}
