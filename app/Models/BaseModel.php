<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\{Model, Builder};
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\BaseModel
 *
 * @method static Builder|self newModelQuery()
 * @method static Builder|self newQuery()
 * @method static Builder|self query()
 * @method static Builder|self filter(array $data)
 */

abstract class BaseModel extends Model
{
    use HasFactory, HasTranslations, Notifiable;

    protected $fillable = [];
    protected $hidden = [];
    protected $casts = [];
    public $translatable = [];
}
