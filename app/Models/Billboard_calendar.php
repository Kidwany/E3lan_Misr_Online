<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billboard_calendar extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billboard_calendar';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['billboard_id', 'starts', 'end'];

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
    protected $dates = ['starts', 'end'];

    public function billboard()
    {
        return $this->belongsTo(Billboard::class, 'billboard_id', 'id');
    }
}
