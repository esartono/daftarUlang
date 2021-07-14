<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Upload;
use App\Models\Uploadtk;

use FastExcel;
use PDF;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // $unit = $request->unit;
        $no = 0;
        $units = array('tk', 'sd', 'smp', 'sma');

        $ext = $request->file->getClientOriginalExtension();
        // $path = $request->file('file')->storeAs('public/files', $request->unit.'.'.$ext);
        $path = $request->file('file')->storeAs('public/files', 'tagihan.'.$ext);

        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // $tagihan = fastexcel()->import($storagePath.'public/files/'.$request->unit.'.'.$ext);

        foreach ($units as $n=>$u)
        {
            $tagihan = fastexcel()->sheet($n+1)->import($storagePath.'public/files/'.'tagihan.'.$ext);
            $unit = strtoupper($u);
            $ket = array();
            foreach ($tagihan as $tgh)
            {
                $no++;
                foreach ($tgh as $k => $t) {
                    switch ($k) {
                        case 'NIS':
                            $nis = $t;
                            break;
                        case 'No. Srt':
                            $srt = $t;
                            break;
                        case 'Nama Siswa':
                            $nama = $t;
                            break;
                        case 'Kelas':
                            $kelas = $t;
                            break;
                        case 'No VA':
                            $va = $t;
                            break;
                        case 'Bank':
                            $bank = $t;
                            break;
                        default:
                            $ket[$k] = $t;
                    }
                }
                if ($unit === 'TK') {
                    Uploadtk::updateOrCreate(
                        [
                            'unit' => $unit,
                            'nis' => $nis
                        ],[
                            'surat' => $srt,
                            'nama' => $nama,
                            'kelas' => $kelas,
                            'va' => $va,
                            'bank' => $bank,
                            'ket' => $ket,
                        ]);
                } else {
                    Upload::updateOrCreate(
                        [
                            'unit' => $unit,
                            'nis' => $nis
                        ],[
                            'surat' => $srt,
                            'nama' => $nama,
                            'kelas' => $kelas,
                            'va' => $va,
                            'bank' => $bank,
                            'ket' => $ket,
                        ]);
                }
            }
        }

        // return compact('no');
        return redirect('home')->with('message', 'Berhasil Upload sebanyak : '. $no . ' data.');
    }

    public function cetakPDF($kelas)
    {
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

        $data = Upload::where('kelas', $kelas)->get()->toArray();

        foreach($data as $d){
            $nFile = $d['nis'];
            Storage::disk('local')->makeDirectory('public/files/'.$d['unit'].'/'.$kelas);
            PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->save('../storage/app/public/files/'.$d['unit'].'/'.$kelas.'/'.$nFile.'.pdf');
        }
    }

    public function cetakPDFTK($kelas)
    {
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

        $data = Uploadtk::where('kelas', $kelas)->get()->toArray();

        foreach($data as $d){
            $nFile = $d['nama'];
            Storage::disk('local')->makeDirectory('public/files/'.$d['unit'].'/'.$kelas);
            PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->save('../storage/app/public/files/'.$d['unit'].'/'.$kelas.'/'.$nFile.'.pdf');
        }
    }

    public function cetak($unit)
    {
        $kelas = DB::table('uploads')->distinct()->select('kelas')->where('unit', $unit)->get()->toArray();

        foreach($kelas as $k){
            $this->cetakPDF($k->kelas);
        }

    }

    public function generatePDF()
    {
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

        // $d = Upload::where('nis', '192010057')->first();
        // PDF::loadView('pdf.'.$d['unit'], compact('d', 'unitnya'))->stream($d['nis'].'.pdf');
        // PDF::loadView('pdf.suratdaul', compact('d', 'unitnya', 'kelasnya', 'kepseknya'))->stream($d['nis'].'.pdf');

        ini_set('max_execution_time', 6000);
        $kelas = DB::table('uploadtks')->distinct()->select('kelas')->where('unit', 'TK')->get()->toArray();

        // foreach($kelas as $k){
        //     $this->cetakPDFTK($k->kelas);
        // }

        // foreach($kelas as $k){
        //     $this->cetakPDFTK($k->kelas);
        // }

        // $kelas = DB::table('uploads')->distinct()->select('kelas')->where('unit', 'SD')->get()->toArray();

        // foreach($kelas as $k){
        //     $this->cetakPDF($k->kelas);
        // }

        // $kelas = DB::table('uploads')->distinct()->select('kelas')->where('unit', 'SMP')->get()->toArray();
        // foreach($kelas as $k){
        //     $this->cetakPDF($k->kelas);
        // }

        // $kelas = DB::table('uploads')->distinct()->select('kelas')->where('unit', 'SMA')->get()->toArray();
        // foreach($kelas as $k){
        //     $this->cetakPDF($k->kelas);
        // }
    }

    public function ok()
    {

        $d = Upload::where('unit', 'SD')->first()->toArray();

    }

    public function SD($unit)
    {
        $d = Upload::where('unit', $unit)->first();
        return view('pdf.'.$d['unit'], compact('d'));
    }
}
