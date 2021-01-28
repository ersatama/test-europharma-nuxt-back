<?php

namespace App\Models;

use App\Contracts\FilterContract;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\CharacteristicContract;

class Characteristic extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table    =   CharacteristicContract::TABLE;
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded  =   [CharacteristicContract::ID];
    protected $fillable =   CharacteristicContract::FILLABLE;
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
    public function filter() {
        return $this->hasOne(Filter::class,FilterContract::ID,CharacteristicContract::FILTER_ID);
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
