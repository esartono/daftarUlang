<?php

namespace App\Http\Controllers;

use App\Models\Email;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use FastExcel;
use PDF;

class EmailController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = 0;

        $ext = $request->file->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('public/files', 'emails.'.$ext);

        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        $email = fastexcel()->import($storagePath.'public/files/'.'emails.'.$ext);
        foreach ($email as $eml)
        {
            $no++;
            foreach ($eml as $k => $e) {
                switch ($k) {
                    case 'nis':
                        $nis = $e;
                        break;
                    case 'email':
                        $email = $e;
                        break;
                    case 'nama':
                        $nama = $e;
                        break;
                    case 'kelas':
                        $kelas = $e;
                        break;
                }
            }
            Email::updateOrCreate(
                [
                    'nis' => $nis
                ],[
                    'email' => $email,
                    'nama' => $nama,
                    'kelas' => $kelas,
                ]);
        }
        return redirect('home')->with('message', 'Berhasil Upload sebanyak : '. $no . ' data.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
