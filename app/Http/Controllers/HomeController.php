<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Daul;
use App\Models\Upload;
use App\Models\Uploadtk;
use App\Models\Email;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use DataTables;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('qrcode');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function gantipassword()
    {
        return view('gantipassword');
    }

    public function gantipasswordnya(Request $request)
    {
        $user = User::whereId(auth()->user()->id)->first();

        $user->password = \Hash::make($request->new);
        $user->update();

        return view('home');
    }

    public function upload()
    {
        return view('upload.tagihan');
    }

    public function cetak($jenis, $nis)
    {
        if ($jenis == 'daul'){
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
                if($d){
                    PDF::loadView('pdf.lunas', compact('d', 'unitnya', 'cek', 'color'))->stream('Kartu Daftar Ulang - '.$d['nama'].'.pdf');
                } else {
                    $d = Uploadtk::where('nis', $nis)->first();
                    PDF::loadView('pdf.lunas', compact('d', 'unitnya', 'cek', 'color'))->stream('Kartu Daftar Ulang - '.$d['nama'].'.pdf');
                }
            }
        }

        if ($jenis == 'surat'){
            $unitnya = [
                'TK' => 'TKIT Nurul Fikri',
                'SD' => 'SDIT Nurul Fikri',
                'SMP' => 'SMPIT Nurul Fikri',
                'SMA' => 'SMAIT Nurul Fikri',
            ];

            $kelasnya = [
                'TK' => 'PG/A',
                'SD' => '1/2/3/4/5',
                'SMP' => '7/8',
                'SMA' => '10/11',
            ];

            $kepseknya = [
                'TK' => 'Muji Rahayu',
                'SD' => 'Fahmi Irvansyah',
                'SMP' => 'Teddy Azra',
                'SMA' => 'Mohammad Furqon',
            ];

            $d = Upload::where('nis', $nis)->first();
            if($d){
                PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->stream($d['nis'].'.pdf');
            } else {
                $d = Uploadtk::where('nis', $nis)->first();
                PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->stream($d['nis'].'.pdf');
            }
        }
    }

    public function kirim($jenis, $nis)
    {
        if ($jenis == 'daul'){
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

                        $m->to(Email::emailnya($d['nis']), $d['nama'])
                            ->from('daftarulang@nurulfikri.sch.id', 'Bagian Keuangan SIT Nurul Fikri')
                            ->attach('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/Kartu Daftar Ulang - '.$nFile.'.pdf', [
                                'mime' => 'application/pdf',
                            ])
                            ->subject('Kartu Daftar Ulang SIT Nurul Fikri');
                    }
                );
            }
        }

        if ($jenis == 'surat'){
            $unitnya = [
                'TK' => 'TKIT Nurul Fikri',
                'SD' => 'SDIT Nurul Fikri',
                'SMP' => 'SMPIT Nurul Fikri',
                'SMA' => 'SMAIT Nurul Fikri',
            ];

            $kelasnya = [
                'TK' => 'PG/A',
                'SD' => '1/2/3/4/5',
                'SMP' => '7/8',
                'SMA' => '10/11',
            ];

            $kepseknya = [
                'TK' => 'Muji Rahayu',
                'SD' => 'Fahmi Irvansyah',
                'SMP' => 'Teddy Azra',
                'SMA' => 'Mohammad Furqon',
            ];

            $d = Upload::where('nis', $nis)->first();
            if(!$d){
                $d = Uploadtk::where('nis', $nis)->first();
                if(!$d){
                    return redirect('home')->with('message', 'Gagal kirim Email');
                }
            }
            if($d){
                if($d['unit'] == 'TK'){
                    $nFile = $d['nama'];
                }

                if($d['unit'] !== 'TK'){
                    $nFile = $d['nis'];
                }

                Storage::disk('local')->makeDirectory('public/files/'.$d['unit'].'/'.$d['kelas']);
                PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->save('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/'.$nFile.'.pdf');

                Mail::send('emails.edaran', compact('d', 'unitnya'), function ($m) use ($d)
                    {
                        if($d['unit'] == 'TK'){
                            $nFile = $d['nama'];
                        }

                        if($d['unit'] !== 'TK'){
                            $nFile = $d['nis'];
                        }

                        $m->to(Email::emailnya($d['nis']), $d['nama'])
                            ->from('daftarulang@nurulfikri.sch.id', 'Bagian Keuangan SIT Nurul Fikri')
                            ->attach('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/'.$nFile.'.pdf', [
                                'mime' => 'application/pdf',
                            ])
                            ->subject('Edaran Daftar Ulang SIT Nurul Fikri');
                    }
                );
            }
        }
        return redirect('home');
    }

    public function kirimall()
    {
        $unitnya = [
            'TK' => 'TKIT Nurul Fikri',
            'SD' => 'SDIT Nurul Fikri',
            'SMP' => 'SMPIT Nurul Fikri',
            'SMA' => 'SMAIT Nurul Fikri',
        ];

        ini_set('max_execution_time', 6000);
        $error = 0;
        // $kelas = DB::table('uploads')->distinct()->select('kelas')->where('unit', 'SD')->get()->toArray();
        // $kelas = DB::table('uploadtks')->distinct()->select('kelas')->where('unit', 'TK')->get()->toArray();
        $kelas = DB::table('uploadtks')->distinct()->select('kelas')->where('kelas', 'B')->get()->toArray();
        // $kelas = DB::table('uploads')->distinct()->select('kelas')->get()->toArray();

        // dd($kelas);
        foreach($kelas as $k){
            $siswa = Upload::where('kelas', $k->kelas)->select('nis')->get();
            if(count($siswa) == 0) {
                $siswa = Uploadtk::where('kelas', $k->kelas)->select('nis')->get();
            }
            foreach($siswa as $s){
                if($s->nis <> ''){
                    $d = Upload::where('nis', $s->nis)->first();
                    if(!$d){
                        $d = Uploadtk::where('nis', $s->nis)->first();
                        if(!$d){
                            $error++;
                        }
                    }
                    if(Email::emailnya($d->nis) !== '-'){
                        Mail::send('emails.edaran', compact('d', 'unitnya'), function ($m) use ($d)
                        {
                            if($d['unit'] == 'TK'){
                                $nFile = $d['nama'];
                            }
                            if($d['unit'] !== 'TK'){
                                $nFile = $d['nis'];
                            }

                            $m->to(Email::emailnya($d->nis), $d->nama)
                            ->from('daftarulang@nurulfikri.sch.id', 'Bagian Keuangan SIT Nurul Fikri')
                            ->attach('../storage/app/public/files/'.$d['unit'].'/'.$d['kelas'].'/'.$nFile.'.pdf', [
                                'mime' => 'application/pdf',
                                ])
                                ->subject('Edaran Daftar Ulang SIT Nurul Fikri');
                            }
                        );
                    }
                }
            }
        }
    }

    public function datasiswa(Request $request)
    {
        $unit = $request->unit;
        if ($unit == 'TK'){
            $row = DB::table('uploadtks')
                ->select('uploadtks.nis', 'uploadtks.unit', 'uploadtks.nama', 'uploadtks.kelas', 'uploadtks.ket', 'uploadtks.va', 'uploadtks.bank', 'emails.email')
                ->leftJoin('emails', 'uploadtks.nis', '=', 'emails.nis');
        }
        if ($unit !== 'TK'){
            $row = DB::table('uploads')
                ->select('uploads.nis', 'uploads.unit', 'uploads.nama', 'uploads.kelas', 'uploads.va', 'uploads.bank', 'uploads.ket','emails.email as email')
                ->leftJoin('emails', 'uploads.nis', '=', 'emails.nis')
                ->where('uploads.unit', $unit);
        }
        return Datatables::of($row)
            ->addIndexColumn()
            ->editColumn('va', function($row){
                return $row->bank . " : " . $row->va;
            })
            ->addColumn('tagihan', function($row){
                $tagihannyas = explode(',', $row->ket);
                $tagihannya = explode(':', $tagihannyas[5]);
                return number_format($tagihannya[1]);
            })
            ->addColumn('daul', function($row){
                return '<a href="cetak/surat/'.$row->nis.'" class=" btn btn-success btn-sm">Cetak</a>';
            })
            ->addColumn('emaildaul', function($row){
                return '<a href="kirim/surat/'.$row->nis.'" class="btn btn-primary btn-sm">Kirim</a>';
            })
            ->rawColumns(['daul', 'emaildaul', 'tagihan'])
            ->escapeColumns([])->make(true);
    }

    public function datadaul(Request $request)
    {
        $unit = $request->unit;

        if ($unit == 'TK'){
            $row = DB::table('uploadtks')
                ->select('uploadtks.nis', 'uploadtks.unit', 'uploadtks.nama', 'uploadtks.kelas', 'uploadtks.ket', 'uploadtks.va', 'uploadtks.bank', 'dauls.lunas')
                ->leftJoin('dauls', 'uploadtks.nis', '=', 'dauls.nis');
        }
        if ($unit !== 'TK'){
            $row = DB::table('uploads')
                ->select('uploads.nis', 'uploads.unit', 'uploads.nama', 'uploads.kelas', 'uploads.va', 'uploads.bank', 'uploads.ket', 'dauls.lunas')
                ->leftJoin('dauls', 'uploads.nis', '=', 'dauls.nis')
                ->where('uploads.unit', $unit);
        }

        $request->lunas == 'SUDAH LUNAS' ? $row->whereNotNull('lunas') : $row->whereNull('lunas');

        return Datatables::of($row)
            ->addIndexColumn()
            ->editColumn('va', function($row){
                return $row->bank . " : " . $row->va;
            })
            ->addColumn('tagihan', function($row){
                $tagihannyas = explode(',', $row->ket);
                $tagihannya = explode(':', $tagihannyas[5]);
                return number_format($tagihannya[1]);
            })
            ->addColumn('daul', function($row){
                return '<a href="cetak/daul/'.$row->nis.'" class="btn btn-success btn-sm">Cetak</a>';
            })
            ->addColumn('emaildaul', function($row){
                if($row->lunas){
                    return '<a href="kirim/daul/'.$row->nis.'" class="btn btn-primary btn-sm">Kirim</a>';
                } else {
                    return '<btn class="btn btn-warning btn-sm" onclick="clickBayar('.$row->nis.')">Bayar</btn>';
                }
            })
            ->rawColumns(['daul', 'emaildaul', 'tagihan'])
            ->escapeColumns([])->make(true);
    }

    public function qrcode($qrcode)
    {
        $cek = Daul::where('qrcode', $qrcode)->first();

        if($cek){
            $this->cetak('daul', $cek->nis);
        }
    }
}
