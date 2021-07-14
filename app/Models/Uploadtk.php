<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploadtk extends Model
{
    protected $fillable = [
        'unit', 'nis', 'surat', 'nama', 'kelas', 'va', 'bank', 'ket', 'tagihan'
    ];

    protected $casts = [
        'ket' => 'array',
    ];

    // protected $appends = [
    //     'va', 'bank'
    // ];

    // public function getVaAttribute()
    // {
    //     // $va = $this->ket['No VA'];
    //     if($this->ket['No VA']){
    //         return $this->ket['No VA'];
    //     } else {
    //         return '-';
    //     }
    // }

    // public function getBankAttribute()
    // {
    //     // $bank = $this->ket['Bank'];
    //     if($this->ket['Bank']){
    //         return $this->ket['Bank'];
    //     } else {
    //         return '-';
    //     }
    // }
}
