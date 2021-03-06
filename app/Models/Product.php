<?php

namespace App\Models;

use App\Contracts\BrandContract;
use App\Contracts\CharacteristicContract;
use App\Contracts\FilterContract;
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
    public function characteristics()
    {
        return $this->hasMany(Characteristic::class,CharacteristicContract::PRODUCT_ID);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,ProductContract::MENU_ID);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,ProductContract::BRAND_ID);
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
