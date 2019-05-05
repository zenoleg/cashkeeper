<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'zen_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'balance',
    ];

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

}
