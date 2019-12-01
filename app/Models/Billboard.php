<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billboard extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billboard';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'image_id',
        'service_id',
        'sub_service_id',
        'parent_location_id',
        'child_location_id',
        'child_of_child_location_id',
        'size_id',
        'dimension',
        'location',
        'supplier_id',
        'type_id',
        'created_by'
    ];

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
    protected $dates = [];

    public function campaign()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_items', 'billboard_id', 'campaign_id');
    }

    public function billboard_en()
    {
        return $this->hasOne(\App\Models\English\Billboard::class, 'billboard_id', 'id')->withDefault();
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id')->withDefault();
    }

    public function billboardSize()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id')->withDefault();
    }

    public function parentLocation()
    {
        return $this->belongsTo(Parent_location::class, 'parent_location_id', 'id')->withDefault();
    }

    public function childLocation()
    {
        return $this->belongsTo(Child_location::class, 'child_location_id', 'id')->withDefault();
    }

    public function childOfChildLocation()
    {
        return $this->belongsTo(Child_of_child_location::class, 'child_of_child_location_id', 'id')->withDefault();
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id')->withDefault();
    }

    public function subService()
    {
        return $this->belongsTo(Service::class, 'sub_service_id', 'id')->withDefault();
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'billboard_images', 'billboard_id','image_id')->withTimestamps();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Billboard_type::class, 'type_id', 'id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function calendar()
    {
        return $this->hasMany(Billboard_calendar::class, 'billboard_id', 'id');
    }

}
