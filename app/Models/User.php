<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'email',
        'phone',
        'password',
        'balance',
        'role',
        'market_name',
        'status'
    ];
    // Start global scope
    public function scopeSearch(Builder $builder, $query)
    {
        // Set default 'query' value to null if it's not passed in the $query array
        $keyword = array_merge([
            'query' => null,
            'role'=>null,
        ], $query);
    
        $builder->when(Arr::get($keyword, 'query'), function (Builder $builder, $queryValue) {
            $builder->where(function (Builder $query) use ($queryValue) {
                $query->whereHas('profile', function (Builder $subQuery) use ($queryValue) {
                    $subQuery->where('full_name', 'like', '%' . $queryValue . '%');
                })->orWhere('phone', 'like', '%' . $queryValue . '%');
            });
        });
        // Apply filtering by 'role' if provided
        $builder->when($keyword['role'], function (Builder $builder, $filterType) {
            $builder->whereIn('role', $filterType);
        });
    }
    // end global scope

    // start relationships
        public function profile(){
            return $this->hasOne(Profile::class,'user_id','id')->withDefault();
        }
        public function cart(){
            return $this->hasOne(Cart::class,'user_id','id');
        }
        public function contacts(){
            return $this->hasMany(Contact::class,'user_id','id');
        }
        public function addresses(){
            return $this->hasMany(Address::class,'user_id','id');
        }
        public function orders(){
            return $this->hasMany(Order::class,'user_id','id');
        }
        public function favorites(){
            return $this->hasMany(Favorite::class,'user_id','id');
        }
    // end relationships

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('avatar');        
    }
}
