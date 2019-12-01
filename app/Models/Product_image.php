<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_images';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'isimage', 'isvideo', 'product_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['isimage' => 'boolean', 'isvideo' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_at', 'end_at', 'starts', 'end'];

    public function service_product()
    {
        return $this->belongsTo(Service_Product::class,  'product_id','id');
        
    }

}