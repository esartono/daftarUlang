<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'nis', 'email', 'nama', 'kelas'
    ];

    public static function emailnya($id)
    {
        $cek = static::where('nis', '=', $id)->first();
        if($cek) {
            return $cek->email;
        } else {
            return '-';
        }
    }
}
