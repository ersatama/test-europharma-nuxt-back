<?php

namespace App\Models;

use App\Contracts\MenuContract;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\ProductContract;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table    =   ProductContract::TABLE;
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded  =   [ProductContract::ID];
    protected $fillable =   ProductContract::FILLABLE;
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function menu()
    {
        return $this->belongsToMany(Menu::class,MenuContract::ID,ProductContract::MENU_ID);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
