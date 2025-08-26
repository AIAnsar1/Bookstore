<?php

namespace App\Models;


class Country extends BaseModel
{
    public $translatable = ['country_info'];

    protected $fillable = [
        'country_info',
        'parent_id',
    ];

    protected $casts = [];

    public function regions()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['country']))
        {
            $query->whereNull('parent_id');
        }

        if (isset($data['region']))
        {
            $query->whereNotNull('parent_id')->with('country');
        }
    }
}
