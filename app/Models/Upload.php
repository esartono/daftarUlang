<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'unit', 'nis', 'surat', 'nama', 'kelas', 'va', 'bank', 'ket', 'tagihan'
    ];

    protected $casts = [
        'ket' => 'array',
    ];

    protected $appends = [
        'tagihan'
    ];

    public function getTagihanAttribute()
    {
        if($this->ket['Total Tagihan']){
            return $this->ket['Total Tagihan'];
        } else {
            return '-';
        }
    }

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
