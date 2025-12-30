<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $table = 'parametres';
    protected $primaryKey = 'id_parametre';
    protected $fillable = ['cle', 'valeur', 'description'];

    public static function get($key, $default = null)
    {
        $param = self::where('cle', $key)->first();
        return $param ? $param->valeur : $default;
    }

    public static function set($key, $value, $description = null)
    {
        return self::updateOrCreate(
            ['cle' => $key],
            ['valeur' => $value, 'description' => $description]
        );
    }
}
