<?php

namespace App\Models;

use App\Contracts\CharacteristicContract;
use App\Contracts\DefaultValueContract;
use App\Contracts\MenuContract;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\FilterContract;

class Filter extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table    =   FilterContract::TABLE;
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded  =   [FilterContract::ID];
    protected $fillable =   FilterContract::FILLABLE;
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
        return $this->hasMany(Menu::class,MenuContract::ID,FilterContract::MENU_ID);
    }

    public function characteristic() {
        return $this->belongsTo(Characteristic::class,CharacteristicContract::FILTER_ID,FilterContract::ID);
    }

    public function defaultValue() {
        return $this->hasMany(DefaultValue::class,DefaultValueContract::FILTER_ID,FilterContract::ID);
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
