<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'zen_categories';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Возвращает ID категории по имени
     *
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public static function getIdByName(string $name)
    {
        $id = Category::where('name', $name)->value('id');

        if ($id === null) {
            throw new Exception(sprintf("Cant find category with name %s", $name));
        }

        return $id;
    }

}
