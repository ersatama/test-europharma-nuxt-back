<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BrandContract;

class Brand extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table    = BrandContract::TABLE;
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded  = [BrandContract::ID];
    protected $fillable = BrandContract::FILLABLE;
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
    public function setIconAttribute($value)
    {
        $disk = config('backpack.base.root_disk_name');

        if ($value==null) {
            \Storage::disk($disk)->delete($this->{BrandContract::ICON});
            $this->attributes[BrandContract::ICON] = null;
        }

        if (\Str::startsWith($value, 'data:image')) {
            $image = \Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            \Storage::disk($disk)->put(BrandContract::ICON_PATH.'/'.$filename, $image->stream());
            \Storage::disk($disk)->delete($this->{BrandContract::ICON});
            $public_destination_path = \Str::replaceFirst('public/', '', BrandContract::ICON_PATH);
            $this->attributes[BrandContract::ICON] = BrandContract::PATH.'/'.$public_destination_path.'/'.$filename;
        }
    }

    public function setImgAttribute($value)
    {
        $disk = config('backpack.base.root_disk_name');

        if ($value==null) {
            \Storage::disk($disk)->delete($this->{BrandContract::IMG});
            $this->attributes[BrandContract::IMG] = null;
        }

        if (\Str::startsWith($value, 'data:image')) {
            $image = \Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            \Storage::disk($disk)->put(BrandContract::IMG_PATH.'/'.$filename, $image->stream());
            \Storage::disk($disk)->delete($this->{BrandContract::IMG});
            $public_destination_path = \Str::replaceFirst('public/', '', BrandContract::IMG_PATH);
            $this->attributes[BrandContract::IMG] = BrandContract::PATH.'/'.$public_destination_path.'/'.$filename;
        }
    }
}
