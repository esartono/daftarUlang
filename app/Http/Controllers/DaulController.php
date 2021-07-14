<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Email;
use App\Models\Upload;
use App\Models\Uploadtk;
use App\Models\Daul;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PDF;

class DaulController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lunas = $request->lunas == 1 ? 'SUDAH LUNAS' : 'BELUM LUNAS';
        return view('daul', compact('lunas'));
    }

    public function bayar($nis)
    {
        $daul = Upload::where('nis', $nis)->first();
        if(!$daul){
            $daul = Uploadtk::where('nis', $nis)->first();
        }
        return view('bayar', compact('daul'));
    }

    public function store(Request $request)
    {
        $nis = $request->nis;
        Daul::updateOrCreate(
            [
                'nis' => $nis
            ],[
                'lunas' => true,
                'qrcode' => Str::random(30)
            ]);

        $lunas = 'BELUM LUNAS';

        $color = [
            'TK' => [255, 195, 0, 255, 195, 0],
            'SD' => [255, 195, 0, 255, 195, 0],
            'SMP' => [255, 195, 0, 255, 195, 0],
            'SMA' => [255, 195, 0, 255, 195, 0],
        ];
        $unitnya = [
            'TK' => 'TK Islam Terpadu Nurul Fikri',
            'SD' => 'SD Islam Terpadu Nurul Fikri',
            'SMP' => 'SMP Islam Terpadu Nurul Fikri',
            'SMA' => 'SMA Islam Terpadu Nurul Fikri',
        ];
        $cek = Daul::where('nis', $nis)->first();
        if($cek){
            $d = Upload::where('nis', $nis)->first();
            if(!$d){
                $d = Uploadtk::where('nis', $nis)->first();
                if(!$d){
                    return redirect('home')->with('message', 'Gagal kirim Email');
                }
            }
            if($d['unit'] == 'TK'){
                $nFile = $d['nama'];
            }

            if($d['unit'] !== 'TK'){
                $nFile = $d['nis'];
            }
            Storage::disk('local')->makeDirectory('public/files/'.$d['unit'].'/'.$d['kelas']);
            PDF::loadView('pdf.lunas', compact('d', 'unitnya', 'cek', 'color'))->save('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/Kartu Daftar Ulang - '.$nFile.'.pdf');

            Mail::send('emails.lunas', compact('d', 'unitnya'), function ($m) use ($d)
                {
                    if($d['unit'] == 'TK'){
                        $nFile = $d['nama'];
                    }

                    if($d['unit'] !== 'TK'){
                        $nFile = $d['nis'];
                    }

                    $m->to(Email::emailnya($nFile), $d->nama)
                        ->from('daftarulang@nurulfikri.sch.id', 'Bagian Keuangan SIT Nurul Fikri')
                        ->attach('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/Kartu Daftar Ulang - '.$nFile.'.pdf', [
                            'mime' => 'application/pdf',
                        ])
                        ->subject('Kartu Daftar Ulang SIT Nurul Fikri');
                }
            );
        }

        return view('daul', compact('lunas'));
    }

    public function show($nis)
    {
        $daul = Upload::where('nis', $nis)->first();
        if(!$daul){
            $daul = Uploadtk::where('nis', $nis)->first();
        }
        return $daul;
    }
}
