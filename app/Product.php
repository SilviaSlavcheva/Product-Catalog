<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use User;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'active',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * check if user has permition
     *
     * @return boolean
     */

    public function isEditable()
    {
        return Auth::guard('api')->id() == $this->user_id;
    }

    /**
     * Get the product's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the product's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
