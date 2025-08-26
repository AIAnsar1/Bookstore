<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasTranslations;

    public $translatable = [];


    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'email',
        'phone_number',
        'photo',
        'country_id',
        'email_verified_at',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $with = [
        'roles'
    ];

    public function getActiveRole()
    {
        return $this->roles()->where('status', \App\Constants\GeneralStatus::STATUS_ACTIVE)->first();
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['firstname'])) {
            $query->where('firstname', 'like', '%' . $data['firstname'] . '%');
        }

        if (isset($data['role'])) {
            $query->whereHas('roles', function ($q) use ($data) {
                $q->where('name', $data['role']);
            });
        }

        return $query;
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function Userroles(): HasMany
    {
        return $this->hasMany(UserRoles::class);
    }
}
