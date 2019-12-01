<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_Product extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'client', 'url', 'service_id'];

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
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_at', 'end_at', 'starts', 'end'];


    public function service_id()
    {
        return $this->hasOne(Service::class, 'id', 'id');
    }

}